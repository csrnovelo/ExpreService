USE [DBServices]
GO
/****** Object:  Table [dbo].[carrusel]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[carrusel](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[nombre_ext] [varchar](50) NULL,
	[descripcion] [varchar](50) NULL,
	[estatus] [tinyint] NULL,
	[orden] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cat_secciones]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cat_secciones](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](50) NULL,
	[clave] [char](10) NULL,
	[estatus] [tinyint] NULL,
	[orden] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ci_sessions]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ci_sessions](
	[id] [nvarchar](128) NOT NULL,
	[ip_address] [nvarchar](45) NOT NULL,
	[timestamp] [int] NOT NULL,
	[data] [varbinary](max) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[contrataciones]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[contrataciones](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[id_servicio] [int] NOT NULL,
	[id_usuario] [int] NOT NULL,
	[id_direccion] [int] NULL,
	[monto] [float] NOT NULL,
	[estatus] [tinyint] NOT NULL,
	[pagado] [char](10) NULL,
	[fecha_hora] [datetime] NOT NULL,
	[fecha_creacion] [date] NOT NULL,
	[hora_inicio] [time](7) NULL,
	[hora_fin] [time](7) NULL,
 CONSTRAINT [PK_contrataciones] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[criticas]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[criticas](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[id_servicio] [int] NOT NULL,
	[id_cliente] [int] NOT NULL,
	[calificacion] [float] NULL,
	[comentario] [varchar](250) NULL,
	[fecha_creacion] [date] NULL,
	[estatus] [tinyint] NOT NULL,
 CONSTRAINT [PK_criticas] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[metodos_pagos]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[metodos_pagos](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[clave] [varchar](5) NOT NULL,
	[descripcion] [varchar](50) NOT NULL,
	[estatus] [tinyint] NOT NULL,
 CONSTRAINT [PK_metodos_pagos] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pagos]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pagos](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[id_contratacion] [int] NOT NULL,
	[id_metodo_pago] [int] NOT NULL,
	[monto] [float] NOT NULL,
	[fecha_pago] [date] NOT NULL,
 CONSTRAINT [PK_pagos] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[servicios]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[servicios](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[id_usuario] [int] NULL,
	[id_categoria] [int] NOT NULL,
	[titulo] [varchar](50) NOT NULL,
	[descripcion] [text] NOT NULL,
	[precio_hora] [float] NOT NULL,
	[estatus] [tinyint] NOT NULL,
	[fecha_creacion] [date] NOT NULL,
	[img] [varchar](50) NULL,
 CONSTRAINT [PK_servicios] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[servicios_carrusel]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[servicios_carrusel](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_servicio] [int] NOT NULL,
	[img] [varchar](50) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[servicios_categorias]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[servicios_categorias](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[descripcion] [varchar](50) NOT NULL,
	[estatus] [tinyint] NOT NULL,
 CONSTRAINT [PK_servicios_categorias] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[servicios_horarios]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[servicios_horarios](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[id_servicio] [int] NOT NULL,
	[dia] [varchar](50) NOT NULL,
	[hora_inicio] [time](7) NOT NULL,
	[hora_fin] [time](7) NOT NULL,
	[estatus] [tinyint] NOT NULL,
 CONSTRAINT [PK_servicios_horarios] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[usuarios]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuarios](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[nombre] [varchar](150) NOT NULL,
	[apellido_paterno] [varchar](150) NOT NULL,
	[apellido_materno] [varchar](150) NULL,
	[rfc] [varchar](50) NOT NULL,
	[correo] [varchar](150) NOT NULL,
	[contra] [varchar](12) NOT NULL,
	[telefono] [varchar](50) NOT NULL,
	[estatus] [tinyint] NOT NULL,
	[fecha_creacion] [date] NOT NULL,
 CONSTRAINT [PK_usuarios] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[usuarios_direcciones]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuarios_direcciones](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[Id_usuario] [int] NOT NULL,
	[titulo] [varchar](150) NOT NULL,
	[descripcion] [varchar](150) NULL,
	[colonia] [varchar](150) NOT NULL,
	[calle] [varchar](150) NOT NULL,
	[codigo_postal] [varchar](50) NULL,
	[num_exterior] [varchar](150) NOT NULL,
	[num_interior] [varchar](50) NULL,
	[estatus] [tinyint] NOT NULL,
	[fecha_creacion] [date] NOT NULL,
 CONSTRAINT [PK_usuarios_direcciones] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[carrusel] ON 

INSERT [dbo].[carrusel] ([Id], [nombre_ext], [descripcion], [estatus], [orden]) VALUES (1, N'principal.png', N'foto para busqueda', 1, 1)
INSERT [dbo].[carrusel] ([Id], [nombre_ext], [descripcion], [estatus], [orden]) VALUES (2, N'promo1.png', N'foto de publicidad', 1, 2)
INSERT [dbo].[carrusel] ([Id], [nombre_ext], [descripcion], [estatus], [orden]) VALUES (3, N'promo2.png', N'foto para la segunda publicidad', 1, 3)
SET IDENTITY_INSERT [dbo].[carrusel] OFF
GO
SET IDENTITY_INSERT [dbo].[cat_secciones] ON 

INSERT [dbo].[cat_secciones] ([Id], [nombre], [clave], [estatus], [orden]) VALUES (1, N'Lo más vendido', N'LMV       ', 1, 2)
INSERT [dbo].[cat_secciones] ([Id], [nombre], [clave], [estatus], [orden]) VALUES (2, N'Servicios', N'CAT       ', 1, 1)
INSERT [dbo].[cat_secciones] ([Id], [nombre], [clave], [estatus], [orden]) VALUES (3, N'Nosotros', N'NTS       ', 1, 3)
INSERT [dbo].[cat_secciones] ([Id], [nombre], [clave], [estatus], [orden]) VALUES (4, N'Iniciar Sesión', N'INS       ', 1, 4)
INSERT [dbo].[cat_secciones] ([Id], [nombre], [clave], [estatus], [orden]) VALUES (5, N'PERFIL', N'PRF       ', 0, 5)
SET IDENTITY_INSERT [dbo].[cat_secciones] OFF
GO
SET IDENTITY_INSERT [dbo].[contrataciones] ON 

INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (2, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'08:00:00' AS Time), CAST(N'11:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (3, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-20T09:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'09:00:00' AS Time), CAST(N'09:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (4, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-20T09:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'09:00:00' AS Time), CAST(N'09:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (5, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (6, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (7, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (8, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (9, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (10, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (11, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-13' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (12, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-20T08:00:00.000' AS DateTime), CAST(N'2025-05-14' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (13, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-14' AS Date), CAST(N'08:00:00' AS Time), CAST(N'10:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (14, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-14' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (15, 1, 3, NULL, 0, 1, NULL, CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (16, 1, 3, 1, 0, 1, N'P         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (17, 1, 3, 1, 0, 1, N'P         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (18, 1, 3, 1, 50, 1, N'S         ', CAST(N'2025-05-20T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (19, 1, 3, 1, 50, 1, N'S         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (20, 1, 3, 1, 50, 1, N'C         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (21, 1, 3, 1, 150, 1, N'N         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'10:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (22, 1, 3, 1, 150, 1, N'N         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'10:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (23, 1, 3, 1, 150, 1, N'N         ', CAST(N'2025-05-15T08:00:00.000' AS DateTime), CAST(N'2025-05-15' AS Date), CAST(N'08:00:00' AS Time), CAST(N'10:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (24, 1, 3, 1, 50, 1, N'N         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-16' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (25, 1, 3, 1, 50, 1, N'N         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-16' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (26, 1, 3, 1, 50, 1, N'N         ', CAST(N'2025-05-19T08:00:00.000' AS DateTime), CAST(N'2025-05-16' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (27, 1, 3, 1, 50, 1, N'N         ', CAST(N'2025-05-29T08:00:00.000' AS DateTime), CAST(N'2025-05-16' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (28, 1, 3, 1, 50, 1, N'N         ', CAST(N'2025-05-29T08:00:00.000' AS DateTime), CAST(N'2025-05-16' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (29, 1, 3, 1, 50, 1, N'C         ', CAST(N'2025-05-29T08:00:00.000' AS DateTime), CAST(N'2025-05-16' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (30, 2, 13, 8, 120, 1, N'N         ', CAST(N'2025-05-20T09:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'09:00:00' AS Time), CAST(N'12:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (31, 2, 13, 9, 120, 1, N'N         ', CAST(N'2025-05-20T09:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'09:00:00' AS Time), CAST(N'12:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (32, 1, 13, 8, 200, 1, N'N         ', CAST(N'2025-05-21T09:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'09:00:00' AS Time), CAST(N'12:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (33, 1, 13, 8, 200, 1, N'N         ', CAST(N'2025-05-21T09:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'09:00:00' AS Time), CAST(N'12:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (34, 3, 13, 8, 300, 1, N'N         ', CAST(N'2025-05-20T14:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'14:00:00' AS Time), CAST(N'16:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (35, 4, 13, 8, 60, 1, N'N         ', CAST(N'2025-05-20T08:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (36, 4, 13, 9, 60, 1, N'N         ', CAST(N'2025-05-20T08:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (37, 1, 13, 9, 50, 1, N'S         ', CAST(N'2025-05-20T08:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
INSERT [dbo].[contrataciones] ([Id], [id_servicio], [id_usuario], [id_direccion], [monto], [estatus], [pagado], [fecha_hora], [fecha_creacion], [hora_inicio], [hora_fin]) VALUES (38, 4, 14, 11, 60, 1, N'S         ', CAST(N'2025-05-20T08:00:00.000' AS DateTime), CAST(N'2025-05-17' AS Date), CAST(N'08:00:00' AS Time), CAST(N'08:00:00' AS Time))
SET IDENTITY_INSERT [dbo].[contrataciones] OFF
GO
SET IDENTITY_INSERT [dbo].[criticas] ON 

INSERT [dbo].[criticas] ([Id], [id_servicio], [id_cliente], [calificacion], [comentario], [fecha_creacion], [estatus]) VALUES (2, 2, 3, 5, N'Excelente servicio', CAST(N'2025-03-23' AS Date), 1)
INSERT [dbo].[criticas] ([Id], [id_servicio], [id_cliente], [calificacion], [comentario], [fecha_creacion], [estatus]) VALUES (3, 2, 3, NULL, N'Si lo recomiendo', CAST(N'2025-03-23' AS Date), 0)
INSERT [dbo].[criticas] ([Id], [id_servicio], [id_cliente], [calificacion], [comentario], [fecha_creacion], [estatus]) VALUES (4, 2, 3, NULL, N'10 de 10', CAST(N'2025-05-24' AS Date), 0)
INSERT [dbo].[criticas] ([Id], [id_servicio], [id_cliente], [calificacion], [comentario], [fecha_creacion], [estatus]) VALUES (5, 4, 3, NULL, N'Excelente servicio', CAST(N'2025-05-24' AS Date), 1)
INSERT [dbo].[criticas] ([Id], [id_servicio], [id_cliente], [calificacion], [comentario], [fecha_creacion], [estatus]) VALUES (6, 3, 3, NULL, N'Excelente servicio', CAST(N'2025-05-24' AS Date), 1)
SET IDENTITY_INSERT [dbo].[criticas] OFF
GO
SET IDENTITY_INSERT [dbo].[metodos_pagos] ON 

INSERT [dbo].[metodos_pagos] ([Id], [clave], [descripcion], [estatus]) VALUES (1, N'EFEC', N'Efectivo', 1)
INSERT [dbo].[metodos_pagos] ([Id], [clave], [descripcion], [estatus]) VALUES (2, N'TARJ', N'Tarjeta', 1)
INSERT [dbo].[metodos_pagos] ([Id], [clave], [descripcion], [estatus]) VALUES (3, N'TRAN', N'Transferencia', 1)
SET IDENTITY_INSERT [dbo].[metodos_pagos] OFF
GO
SET IDENTITY_INSERT [dbo].[servicios] ON 

INSERT [dbo].[servicios] ([Id], [id_usuario], [id_categoria], [titulo], [descripcion], [precio_hora], [estatus], [fecha_creacion], [img]) VALUES (1, 3, 4, N'Flete', N'El mejor servicio de fletes de Mérida, contamos con una amplia cobertura para transportar tus muebles a cualquier parte de la ciudad', 50, 1, CAST(N'2025-03-10' AS Date), N'3.png')
INSERT [dbo].[servicios] ([Id], [id_usuario], [id_categoria], [titulo], [descripcion], [precio_hora], [estatus], [fecha_creacion], [img]) VALUES (2, 4, 4, N'Transporte privado', N'Transporte cuado lo requieras y necesitas, para llevarte a tu trabajo a tiempo todos los dias', 30, 1, CAST(N'2025-03-08' AS Date), N'4.png')
INSERT [dbo].[servicios] ([Id], [id_usuario], [id_categoria], [titulo], [descripcion], [precio_hora], [estatus], [fecha_creacion], [img]) VALUES (3, 3, 1, N'Limpieza para el hogar', N'Los días que necesites limpeza para tu hogar con mas de 2 años de experiencia', 100, 1, CAST(N'2025-03-14' AS Date), N'6.png')
INSERT [dbo].[servicios] ([Id], [id_usuario], [id_categoria], [titulo], [descripcion], [precio_hora], [estatus], [fecha_creacion], [img]) VALUES (4, 4, 5, N'Instalación de impresoras', N'Instalmos impresoras por medio de IP o por drivers', 60, 1, CAST(N'2025-02-10' AS Date), N'1.png')
INSERT [dbo].[servicios] ([Id], [id_usuario], [id_categoria], [titulo], [descripcion], [precio_hora], [estatus], [fecha_creacion], [img]) VALUES (5, 4, 3, N'Limpieza de Jardín', N'Excelente servicio de jardineria', 50, 1, CAST(N'2025-03-12' AS Date), N'5.png')
INSERT [dbo].[servicios] ([Id], [id_usuario], [id_categoria], [titulo], [descripcion], [precio_hora], [estatus], [fecha_creacion], [img]) VALUES (10, 6, 6, N'Seguridad 24/7', N'Nos encargamos de brindarte la mejor seguridad para tus oficinas', 120, 1, CAST(N'2025-02-14' AS Date), N'2.png')
SET IDENTITY_INSERT [dbo].[servicios] OFF
GO
SET IDENTITY_INSERT [dbo].[servicios_carrusel] ON 

INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (1, 1, N'1.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (2, 1, N'2.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (3, 1, N'3.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (4, 2, N'4.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (5, 2, N'5.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (6, 3, N'6.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (7, 3, N'7.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (8, 3, N'8.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (9, 4, N'9.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (10, 4, N'20.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (11, 4, N'10.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (12, 5, N'11.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (13, 5, N'12.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (14, 5, N'13.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (15, 6, N'14.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (16, 6, N'15.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (17, 6, N'16.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (18, 10, N'17.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (19, 10, N'18.png')
INSERT [dbo].[servicios_carrusel] ([id], [id_servicio], [img]) VALUES (20, 10, N'19.png')
SET IDENTITY_INSERT [dbo].[servicios_carrusel] OFF
GO
SET IDENTITY_INSERT [dbo].[servicios_categorias] ON 

INSERT [dbo].[servicios_categorias] ([Id], [descripcion], [estatus]) VALUES (1, N'Limpieza', 1)
INSERT [dbo].[servicios_categorias] ([Id], [descripcion], [estatus]) VALUES (2, N'Mantenimiento', 1)
INSERT [dbo].[servicios_categorias] ([Id], [descripcion], [estatus]) VALUES (3, N'Jardinería', 1)
INSERT [dbo].[servicios_categorias] ([Id], [descripcion], [estatus]) VALUES (4, N'Mudanza', 1)
INSERT [dbo].[servicios_categorias] ([Id], [descripcion], [estatus]) VALUES (5, N'Tecnología', 1)
INSERT [dbo].[servicios_categorias] ([Id], [descripcion], [estatus]) VALUES (6, N'Seguridad', 1)
SET IDENTITY_INSERT [dbo].[servicios_categorias] OFF
GO
SET IDENTITY_INSERT [dbo].[servicios_horarios] ON 

INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (1, 1, N'Lunes', CAST(N'08:00:00' AS Time), CAST(N'14:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (2, 1, N'Martes', CAST(N'09:00:00' AS Time), CAST(N'13:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (3, 1, N'Miercoles', CAST(N'09:00:00' AS Time), CAST(N'13:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (4, 1, N'Jueves', CAST(N'09:00:00' AS Time), CAST(N'13:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (5, 1, N'Viernes', CAST(N'09:00:00' AS Time), CAST(N'13:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (6, 2, N'Lunes', CAST(N'09:00:00' AS Time), CAST(N'14:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (7, 2, N'Martes', CAST(N'09:00:00' AS Time), CAST(N'14:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (8, 2, N'Miercoles', CAST(N'09:00:00' AS Time), CAST(N'14:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (10, 2, N'Jueves', CAST(N'09:00:00' AS Time), CAST(N'14:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (11, 2, N'Viernes', CAST(N'09:00:00' AS Time), CAST(N'14:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (12, 2, N'Sabado', CAST(N'09:00:00' AS Time), CAST(N'14:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (14, 3, N'Lunes', CAST(N'08:00:00' AS Time), CAST(N'18:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (15, 3, N'Miercoles', CAST(N'08:00:00' AS Time), CAST(N'18:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (16, 3, N'Viernes', CAST(N'08:00:00' AS Time), CAST(N'18:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (17, 4, N'Lunes', CAST(N'08:00:00' AS Time), CAST(N'12:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (18, 4, N'Jueves', CAST(N'08:00:00' AS Time), CAST(N'12:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (19, 4, N'Viernes', CAST(N'08:00:00' AS Time), CAST(N'12:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (20, 4, N'Sabado', CAST(N'08:00:00' AS Time), CAST(N'13:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (21, 5, N'Lunes', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (22, 5, N'Martes', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (23, 5, N'Miercoles', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (24, 5, N'Jueves', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (25, 5, N'Viernes', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (26, 10, N'Lunes', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (27, 10, N'Martes', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (28, 10, N'Miercoles', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (29, 10, N'Jueves', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
INSERT [dbo].[servicios_horarios] ([Id], [id_servicio], [dia], [hora_inicio], [hora_fin], [estatus]) VALUES (30, 10, N'Viernes', CAST(N'09:00:00' AS Time), CAST(N'19:00:00' AS Time), 1)
SET IDENTITY_INSERT [dbo].[servicios_horarios] OFF
GO
SET IDENTITY_INSERT [dbo].[usuarios] ON 

INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (3, N'Cesar', N'Novelo', N'Basulto', N'NOBC200203AHJ', N'cesarnovelo99@gmail.com', N'123', N'9999999', 1, CAST(N'2025-03-10' AS Date))
INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (4, N'Montse', N'Suarez', NULL, N'SUMO123JKL', N'montse@service.com', N'123', N'0000000', 1, CAST(N'2025-03-10' AS Date))
INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (6, N'Angel', N'Dzul', N'Sansores', N'----', N'angel@service.com', N'123', N'00000', 1, CAST(N'2025-03-10' AS Date))
INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (8, N'alberto', N'novelo', N'basulto', N'asasas', N'alberto@service.com', N'123', N'999999', 1, CAST(N'2025-04-08' AS Date))
INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (10, N'rafael', N'gonzalez', N'martinez', N'lkslak', N'r.martinez@example.com', N'Contrase{a14', N'9993047852', 1, CAST(N'2025-04-09' AS Date))
INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (11, N'prueba', N'usuario', N'abril', N'pruuabril', N'prueba@usuario.com', N'123456789CSD', N'88888888', 1, CAST(N'2025-04-09' AS Date))
INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (12, N'prueba', N'mayo', N'viernes', N'asss', N'mayo@correo.com', N'Prueba112345', N'9993047852', 1, CAST(N'2025-05-02' AS Date))
INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (13, N'Alejadro', N'Gongora', N'Escalante', N'ASD456', N'agongoraescalante@gmail.com
', N'Prueba112345', N'9999999', 1, CAST(N'2025-05-16' AS Date))
INSERT [dbo].[usuarios] ([Id], [nombre], [apellido_paterno], [apellido_materno], [rfc], [correo], [contra], [telefono], [estatus], [fecha_creacion]) VALUES (14, N'Vicente', N'Sanchez', N'Giemenez', N'ASDD456', N'cessarnovelo99@gmail.com', N'Prueba112345', N'9999999', 1, CAST(N'2025-05-16' AS Date))
SET IDENTITY_INSERT [dbo].[usuarios] OFF
GO
SET IDENTITY_INSERT [dbo].[usuarios_direcciones] ON 

INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (1, 3, N'casa', N'', N'Mulsay', N'C-4D', N'97217', N'458', N'', 1, CAST(N'2025-04-09' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (2, 3, N'Oficina', N'Edificio de dos pisos', N'Altabrisa', N'C-58', N'97214', N'254', N'', 1, CAST(N'2025-04-09' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (3, 3, N'Casa de mamÃ¡', N'Casa azul, de rejas blancas', N'Centro', N'C-89', N'97000', N'456', N'', 0, CAST(N'2025-04-09' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (4, 3, N'Oficina', N'Edificio de dos pisos', N'Altabrisa', N'C-58', N'97214', N'254', N'', 0, CAST(N'2025-04-11' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (5, 4, N'Casa abuelos', N'', N'pedragales', N'56', N'97250', N'544', N'', 1, CAST(N'2025-04-11' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (6, 12, N'Casa de mamÃ¡', N'Casa azul, de rejas blancas', N'Centro', N'c5', N'97217', N'89', N'', 0, CAST(N'2025-05-02' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (7, 3, N'casa', N'', N'Mulsay', N'C-4D', N'97219', N'458', N'', 0, CAST(N'2025-05-07' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (8, 13, N'Casa de mamÃ¡', N'', N'Centro', N'C-4D', N'9000', N'587', N'', 1, CAST(N'2025-05-16' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (9, 13, N'Casa abuelos', N'', N'Mulsay', N'C-89', N'978888', N'456', N'', 1, CAST(N'2025-05-16' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (10, 13, N'Casa', N'', N'pedragales', N'56', N'789999', N'587', N'', 0, CAST(N'2025-05-16' AS Date))
INSERT [dbo].[usuarios_direcciones] ([Id], [Id_usuario], [titulo], [descripcion], [colonia], [calle], [codigo_postal], [num_exterior], [num_interior], [estatus], [fecha_creacion]) VALUES (11, 14, N'Trabajo', N'', N'Pensiones', N'58', N'89999', N'522', N'', 1, CAST(N'2025-05-16' AS Date))
SET IDENTITY_INSERT [dbo].[usuarios_direcciones] OFF
GO
ALTER TABLE [dbo].[ci_sessions] ADD  DEFAULT ((0)) FOR [timestamp]
GO
ALTER TABLE [dbo].[contrataciones]  WITH CHECK ADD  CONSTRAINT [FK_contrataciones_servicios] FOREIGN KEY([id_servicio])
REFERENCES [dbo].[servicios] ([Id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[contrataciones] CHECK CONSTRAINT [FK_contrataciones_servicios]
GO
ALTER TABLE [dbo].[contrataciones]  WITH CHECK ADD  CONSTRAINT [FK_contrataciones_usuarios] FOREIGN KEY([id_usuario])
REFERENCES [dbo].[usuarios] ([Id])
GO
ALTER TABLE [dbo].[contrataciones] CHECK CONSTRAINT [FK_contrataciones_usuarios]
GO
ALTER TABLE [dbo].[criticas]  WITH CHECK ADD  CONSTRAINT [FK_criticas_servicios] FOREIGN KEY([id_servicio])
REFERENCES [dbo].[servicios] ([Id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[criticas] CHECK CONSTRAINT [FK_criticas_servicios]
GO
ALTER TABLE [dbo].[criticas]  WITH CHECK ADD  CONSTRAINT [FK_criticas_usuarios] FOREIGN KEY([id_cliente])
REFERENCES [dbo].[usuarios] ([Id])
GO
ALTER TABLE [dbo].[criticas] CHECK CONSTRAINT [FK_criticas_usuarios]
GO
ALTER TABLE [dbo].[pagos]  WITH CHECK ADD  CONSTRAINT [FK_pagos_contrataciones] FOREIGN KEY([id_contratacion])
REFERENCES [dbo].[contrataciones] ([Id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[pagos] CHECK CONSTRAINT [FK_pagos_contrataciones]
GO
ALTER TABLE [dbo].[pagos]  WITH CHECK ADD  CONSTRAINT [FK_pagos_metodos_pagos] FOREIGN KEY([id_metodo_pago])
REFERENCES [dbo].[metodos_pagos] ([Id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[pagos] CHECK CONSTRAINT [FK_pagos_metodos_pagos]
GO
ALTER TABLE [dbo].[servicios]  WITH CHECK ADD  CONSTRAINT [FK_servicios_servicios_categorias] FOREIGN KEY([id_categoria])
REFERENCES [dbo].[servicios_categorias] ([Id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[servicios] CHECK CONSTRAINT [FK_servicios_servicios_categorias]
GO
ALTER TABLE [dbo].[servicios]  WITH CHECK ADD  CONSTRAINT [FK_servicios_usuarios] FOREIGN KEY([id_usuario])
REFERENCES [dbo].[usuarios] ([Id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[servicios] CHECK CONSTRAINT [FK_servicios_usuarios]
GO
ALTER TABLE [dbo].[servicios_horarios]  WITH CHECK ADD  CONSTRAINT [FK_servicios_horarios_servicios] FOREIGN KEY([id_servicio])
REFERENCES [dbo].[servicios] ([Id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[servicios_horarios] CHECK CONSTRAINT [FK_servicios_horarios_servicios]
GO
ALTER TABLE [dbo].[usuarios_direcciones]  WITH CHECK ADD  CONSTRAINT [FK_usuarios_direcciones_usuarios] FOREIGN KEY([Id_usuario])
REFERENCES [dbo].[usuarios] ([Id])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[usuarios_direcciones] CHECK CONSTRAINT [FK_usuarios_direcciones_usuarios]
GO
/****** Object:  StoredProcedure [dbo].[pa_consultar_carrusel]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[pa_consultar_carrusel]
AS
BEGIN
	SELECT Id, nombre_ext, descripcion, estatus, orden
	FROM carrusel
	WHERE estatus=1
	ORDER BY orden
END
GO
/****** Object:  StoredProcedure [dbo].[pa_consultar_categorias]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[pa_consultar_categorias]
AS
BEGIN
	SELECT Id, descripcion, estatus
	FROM servicios_categorias
	WHERE estatus=1
	ORDER BY descripcion
END
GO
/****** Object:  StoredProcedure [dbo].[pa_consultar_secciones]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[pa_consultar_secciones]
AS
BEGIN
	SELECT Id, nombre, clave, estatus, orden
	FROM cat_secciones
	WHERE estatus=1
	ORDER BY orden
END
GO
/****** Object:  StoredProcedure [dbo].[pa_consultar_servicios]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[pa_consultar_servicios]
AS
BEGIN
    SELECT 
        s.Id, 
        CAST(s.titulo AS NVARCHAR(4000)) AS titulo,
        CAST(s.descripcion AS NVARCHAR(4000)) AS descripcion,
        s.precio_hora, 
        s.estatus, 
        s.fecha_creacion,
        s.img,
        CAST(u.nombre AS NVARCHAR(4000)) AS nombre_usuario, 
        CAST(u.apellido_paterno AS NVARCHAR(4000)) AS apellido_paterno,
        CAST(sc.descripcion AS NVARCHAR(4000)) AS categoria,
        COALESCE(AVG(c.calificacion), 0) AS promedio_calificacion
    FROM servicios s
    INNER JOIN usuarios u ON s.id_usuario = u.Id
    INNER JOIN servicios_categorias sc ON s.id_categoria = sc.Id
    LEFT JOIN criticas c ON s.Id = c.id_servicio
    WHERE s.estatus = 1
    GROUP BY 
        s.Id, 
        CAST(s.titulo AS NVARCHAR(4000)),
        CAST(s.descripcion AS NVARCHAR(4000)),
        s.precio_hora, 
        s.estatus, 
        s.fecha_creacion,
        s.img,
        CAST(u.nombre AS NVARCHAR(4000)), 
        CAST(u.apellido_paterno AS NVARCHAR(4000)),
        CAST(sc.descripcion AS NVARCHAR(4000))
    ORDER BY s.fecha_creacion;
END;
GO
/****** Object:  StoredProcedure [dbo].[pa_detalle_servicio]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[pa_detalle_servicio]
    @p_id INT
AS
BEGIN
    SET NOCOUNT ON; -- Importante para evitar errores con ODBC

    -- Aseguramos que los datos sean devueltos en un cursor
    DECLARE @table TABLE (
        servicio_id INT,
        titulo NVARCHAR(255),
        servicio_descripcion NVARCHAR(MAX),
        precio_hora DECIMAL(10,2),
        servicio_fecha_creacion DATETIME,
        categoria_descripcion NVARCHAR(255),
        usuario_nombre NVARCHAR(100),
        usuario_apellido NVARCHAR(100)
    );

    INSERT INTO @table
    SELECT 
        s.Id AS servicio_id,
        s.titulo,
        s.descripcion AS servicio_descripcion,
        s.precio_hora,
        s.fecha_creacion AS servicio_fecha_creacion,
        sc.descripcion AS categoria_descripcion,
        u.nombre AS usuario_nombre,
        u.apellido_paterno AS usuario_apellido
    FROM 
        servicios s
    JOIN 
        servicios_categorias sc ON s.Id_categoria = sc.Id
    INNER JOIN 
        usuarios u ON s.id_usuario = u.Id
    WHERE 
        s.id = @p_id;

    -- Devolvemos los resultados
    SELECT * FROM @table;
END
GO
/****** Object:  StoredProcedure [dbo].[pa_validar_usuario]    Script Date: 23/05/2025 06:28:46 p. m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[pa_validar_usuario]
    @p_correo VARCHAR(100),
    @p_password VARCHAR(100)
AS
BEGIN
    SET NOCOUNT ON;

    SELECT id, nombre, correo, contra
    FROM usuarios 
    WHERE correo = @p_correo 
    AND contra = @p_password
    AND estatus = 1;
END
GO
