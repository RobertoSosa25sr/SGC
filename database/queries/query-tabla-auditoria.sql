CREATE TABLE [dbo].[audit_logs](
    [id] [bigint] IDENTITY(1,1) NOT NULL,  
    -- Identificador único autoincremental
    -- Ejemplo: 1, 2, 3, ...

	[user_type] [nvarchar](50) NOT NULL,  
    -- Tipo de usuario que realizó la acción
    -- Valores permitidos: 'admin', 'api_user', 'external_user'
    -- Ejemplo: 'api_user'

    [action_type] [nvarchar](50) NOT NULL, 
    -- Tipo de acción realizada en la base de datos
    -- Valores permitidos: 'SELECT', 'INSERT', 'UPDATE', 'DELETE', 'LOGIN'
    -- Ejemplo: 'UPDATE'

    [table_name] [nvarchar](50) NOT NULL,  
    -- Nombre de la tabla afectada por la acción
    -- Ejemplo: 'users', 'customer_data'

    [record_id] [bigint] NULL,             
    -- ID del registro específico afectado
    -- Ejemplo: 5 (si se modificó el usuario con ID 5)

    [affected_columns] [nvarchar](255) NULL, 
    -- Lista de columnas afectadas por la acción
    -- Ejemplo: 'email,phone'

    [old_value] [nvarchar](255) NULL,
    -- Valor anterior del campo modificado (para UPDATEs)
    -- Ejemplo: 'old@email.com'

    [new_value] [nvarchar](255) NULL,
    -- Nuevo valor del campo modificado (para UPDATEs)
    -- Ejemplo: 'new@email.com'

    [created_at] [datetime] NOT NULL DEFAULT GETDATE(),
    -- Fecha y hora de la acción
    -- Ejemplo: '2025-01-27 14:30:00'
    
    CONSTRAINT [PK_audit_logs] PRIMARY KEY CLUSTERED ([id] ASC)
)
GO


-- Ejemplos de registros:

-- Ejemplo 1: Actualización de email de usuario
/*
id: 1
user_type: 'admin'
action_type: 'UPDATE'
table_name: 'users'
record_id: 5
affected_columns: 'email'
old_value: 'old@email.com'
new_value: 'new@email.com'
created_at: '2025-01-27 10:00:00'
*/

-- Ejemplo 2: Consulta de datos
/*
id: 2
user_type: 'api_user'
action_type: 'SELECT'
table_name: 'customer_data'
record_id: NULL
affected_columns: 'name,email,phone'
old_value: NULL
new_value: NULL
created_at: '2025-01-27 10:15:00'
*/

-- Ejemplo 3: Eliminación de registro
/*
id: 3
user_type: 'admin'
action_type: 'DELETE'
table_name: 'users'
record_id: 10
affected_columns: NULL
old_value: 'Registro completo eliminado'
new_value: NULL
created_at: '2025-01-27 10:30:00'
*/
