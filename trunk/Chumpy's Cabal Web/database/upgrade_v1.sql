BEGIN TRANSACTION
	SET TRANSACTION ISOLATION LEVEL SERIALIZABLE
	SET QUOTED_IDENTIFIER ON
	SET ANSI_NULLS ON
	SET ANSI_PADDING ON
	SET ANSI_WARNINGS ON
	SET ARITHABORT ON
	SET NUMERIC_ROUNDABORT OFF
	SET CONCAT_NULL_YIELDS_NULL ON
	SET XACT_ABORT ON
COMMIT TRANSACTION
GO

IF EXISTS (select * from tempdb..sysobjects where id = OBJECT_ID('tempdb..#ErrorLog')) 
	DROP TABLE #ErrorLog 
CREATE TABLE #ErrorLog 
( pkid [int] IDENTITY(1,1) NOT NULL, errno [int] NOT NULL, errdescr [varchar](100) NULL )
GO

IF @@TRANCOUNT=0 BEGIN TRANSACTION
GO
CREATE TABLE [dbo].[Bank] (
	[UserNum] [int] NOT NULL,
	[Alz] [bigint] NOT NULL
) ON [PRIMARY]
GO
IF @@ERROR<>0 
Begin
	IF @@TRANCOUNT>0 ROLLBACK TRANSACTION
	INSERT INTO #ErrorLog (errno,errdescr) values(@@ERROR,'Failed to add table dbo.Bank')
END
GO

ALTER TABLE [dbo].[Bank] ADD 
	CONSTRAINT [DF_Bank_Alz] DEFAULT (0) FOR [Alz]
GO

IF @@TRANCOUNT=0 BEGIN TRANSACTION
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_NULLS OFF
GO


CREATE PROCEDURE [dbo].[GetBankAlz]( @UserNum int ) AS
BEGIN
	if ( SELECT UserNum FROM Bank WHERE UserNum = @UserNum ) is Null 
	BEGIN
		INSERT Bank ( UserNum, Alz)
		VALUES( @UserNum, 0)
	END
	SELECT UserNum, Alz
	FROM Bank
	WHERE UserNum = @UserNum
END



GO
IF @@ERROR<>0 
Begin
	IF @@TRANCOUNT>0 ROLLBACK TRANSACTION
	INSERT INTO #ErrorLog (errno,errdescr) values(@@ERROR,'Failed to add stored procedure dbo.GetBankAlz')
END
GO
SET QUOTED_IDENTIFIER OFF
GO
SET ANSI_NULLS ON
GO

IF @@TRANCOUNT=0 BEGIN TRANSACTION
GO
SET QUOTED_IDENTIFIER OFF
GO
SET ANSI_NULLS OFF
GO

CREATE PROCEDURE SetBankAlz( @UserNum int, @Alz bigint) 
AS
BEGIN
BEGIN TRAN
	IF NOT EXISTS( SELECT UserNum
		FROM Bank
		WHERE UserNum = @UserNum )
	BEGIN
		INSERT Bank	(UserNum, Alz)
		VALUES ( @UserNum, 0)
	END
	ELSE
	BEGIN
		UPDATE Bank
		SET Alz = @Alz
		WHERE UserNum = @UserNum
	END
COMMIT TRAN	
END


GO
IF @@ERROR<>0 
Begin
	IF @@TRANCOUNT>0 ROLLBACK TRANSACTION
	INSERT INTO #ErrorLog (errno,errdescr) values(@@ERROR,'Failed to add stored procedure dbo.SetBankAlz')
END
GO
SET QUOTED_IDENTIFIER OFF
GO
SET ANSI_NULLS ON
GO

IF EXISTS (Select * from #ErrorLog)
BEGIN
	IF @@TRANCOUNT>0 ROLLBACK TRANSACTION
END
ELSE
BEGIN
	IF @@TRANCOUNT>0 COMMIT TRANSACTION
END
IF EXISTS (Select * from #ErrorLog)
BEGIN
	Print 'Database synchronization script failed'
	GOTO QuitWithErrors
END
ELSE
BEGIN
	Print 'Database synchronization completed successfully'
END



QuitWithErrors:


