CREATE TABLE [dbo].[Bank] (
	[UserNum] [int] NOT NULL ,
	[Alz] [bigint] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[ShopItems] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Name] [varchar] (50) COLLATE Chinese_PRC_CI_AS NOT NULL ,
	[Description] [varchar] (200) COLLATE Chinese_PRC_CI_AS NOT NULL ,
	[ItemIdx] [int] NOT NULL ,
	[DurationIdx] [int] NOT NULL ,
	[ItemOpt] [int] NOT NULL ,
	[Image] [varchar] (200) COLLATE Chinese_PRC_CI_AS NOT NULL ,
	[Honour] [int] NULL ,
	[Alz] [int] NULL ,
	[Category] [int] NOT NULL ,
	[Available] [int] NOT NULL 
) ON [PRIMARY]
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
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
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
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

