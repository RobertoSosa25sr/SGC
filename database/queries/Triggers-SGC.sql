-- Trigger para INSERT en la tabla 'users'
DROP TRIGGER IF EXISTS tr_users_audit_insert;
GO

CREATE TRIGGER tr_users_audit_insert
ON users
AFTER INSERT
AS
BEGIN
    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        created_at
    )
    SELECT 
        SYSTEM_USER,
        'INSERT',
        'users',
        inserted.id,	
        GETDATE()
    FROM inserted;
END;
GO

-- Trigger para DELETE en la tabla 'users'
DROP TRIGGER IF EXISTS tr_users_audit_delete;
GO

CREATE TRIGGER tr_users_audit_delete
ON [dbo].[users]
AFTER DELETE
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO [dbo].[audit_logs] (
        [user_type],
        [action_type],
        [table_name],
        [record_id],
        [created_at]
    )
    SELECT
        SYSTEM_USER,
        'DELETE',
        'users',
        id,
        GETDATE()
    FROM deleted;
END;
GO

-- Trigger para UPDATE en la tabla 'users'
DROP TRIGGER IF EXISTS tr_users_audit_update;
GO

CREATE TRIGGER tr_users_audit_update
ON [dbo].[users]
AFTER UPDATE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO [dbo].[audit_logs] (
        [user_type],
        [action_type],
        [table_name],
        [record_id],
        [affected_columns],
        [old_value],
        [new_value],
        [created_at]
    )
    SELECT
        SYSTEM_USER,
        'UPDATE',
        'users',
        i.id,
        'name',
        d.name,
        i.name,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.name <> d.name 
        OR (i.name IS NULL AND d.name IS NOT NULL)
        OR (i.name IS NOT NULL AND d.name IS NULL)

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'users',
        i.id,
        'email',
        d.email,
        i.email,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.email <> d.email 
        OR (i.email IS NULL AND d.email IS NOT NULL)
        OR (i.email IS NOT NULL AND d.email IS NULL)

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'users',
        i.id,
        'phone',
        d.phone,
        i.phone,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.phone <> d.phone 
        OR (i.phone IS NULL AND d.phone IS NOT NULL)
        OR (i.phone IS NOT NULL AND d.phone IS NULL)

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'users',
        i.id,
        'security_question_id',
        CONVERT(NVARCHAR(MAX), d.security_question_id),
        CONVERT(NVARCHAR(MAX), i.security_question_id),
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.security_question_id <> d.security_question_id 
        OR (i.security_question_id IS NULL AND d.security_question_id IS NOT NULL)
        OR (i.security_question_id IS NOT NULL AND d.security_question_id IS NULL)

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'users',
        i.id,
        'security_answer',
        d.security_answer,
        i.security_answer,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.security_answer <> d.security_answer 
        OR (i.security_answer IS NULL AND d.security_answer IS NOT NULL)
        OR (i.security_answer IS NOT NULL AND d.security_answer IS NULL);

END;
GO

-- Trigger para INSERT en la tabla 'notifications'
DROP TRIGGER IF EXISTS tr_notifications_audit_insert;
GO

CREATE TRIGGER tr_notifications_audit_insert
ON [dbo].[notifications]
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO [dbo].[audit_logs] (
        [user_type],
        [action_type],
        [table_name],
        [record_id],
        [created_at]
    )
    SELECT
        SYSTEM_USER,
        'INSERT',
        'notifications',
        id,
        GETDATE()
    FROM inserted;
END;
GO

-- Trigger para DELETE en la tabla 'notifications'
DROP TRIGGER IF EXISTS tr_notifications_audit_delete;
GO

CREATE TRIGGER tr_notifications_audit_delete
ON [dbo].[notifications]
AFTER DELETE
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO [dbo].[audit_logs] (
        [user_type],
        [action_type],
        [table_name],
        [record_id],
        [created_at]
    )
    SELECT
        SYSTEM_USER,
        'DELETE',
        'notifications',
        id,
        GETDATE()
    FROM deleted;
END;
GO

-- Trigger para UPDATE en la tabla 'notifications' (CORRECCIÓN DE 'read')
DROP TRIGGER IF EXISTS tr_notifications_audit_update;
GO

CREATE TRIGGER tr_notifications_audit_update
ON [dbo].[notifications]
AFTER UPDATE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO [dbo].[audit_logs] (
        [user_type],
        [action_type],
        [table_name],
        [record_id],
        [affected_columns],
        [old_value],
        [new_value],
        [created_at]
    )
    SELECT
        SYSTEM_USER,
        'UPDATE',
        'notifications',
        i.id,
        'type',
        d.type,
        i.type,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.type <> d.type
        OR (i.type IS NULL AND d.type IS NOT NULL)
        OR (i.type IS NOT NULL AND d.type IS NULL)

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'notifications',
        i.id,
        'message',
        d.message,
        i.message,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.message <> d.message
        OR (i.message IS NULL AND d.message IS NOT NULL)
        OR (i.message IS NOT NULL AND d.message IS NULL)

    UNION ALL

    -- Usar comillas cuadradas para la columna reservada 'read'
    SELECT
        SYSTEM_USER,
        'UPDATE',
        'notifications',
        i.id,
        '[read]',
        CONVERT(NVARCHAR(5), d.[read]),
        CONVERT(NVARCHAR(5), i.[read]),
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.[read] <> d.[read]

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'notifications',
        i.id,
        'ip_address',
        d.ip_address,
        i.ip_address,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.ip_address <> d.ip_address
        OR (i.ip_address IS NULL AND d.ip_address IS NOT NULL)
        OR (i.ip_address IS NOT NULL AND d.ip_address IS NULL)

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'notifications',
        i.id,
        'user_agent',
        d.user_agent,
        i.user_agent,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.user_agent <> d.user_agent
        OR (i.user_agent IS NULL AND d.user_agent IS NOT NULL)
        OR (i.user_agent IS NOT NULL AND d.user_agent IS NULL)

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'notifications',
        i.id,
        'notified_at',
        CONVERT(NVARCHAR(30), d.notified_at, 126),
        CONVERT(NVARCHAR(30), i.notified_at, 126),
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.notified_at <> d.notified_at
        OR (i.notified_at IS NULL AND d.notified_at IS NOT NULL)
        OR (i.notified_at IS NOT NULL AND d.notified_at IS NULL);

END;
GO

-- Trigger para INSERT en la tabla 'permisos'
DROP TRIGGER IF EXISTS tr_permisos_audit_insert;
GO

CREATE TRIGGER tr_permisos_audit_insert
ON permisos
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        created_at
    )
    SELECT 
        SYSTEM_USER,
        'INSERT',
        'permisos',
        inserted.id,    
        GETDATE()
    FROM inserted;
END;
GO

-- Trigger para DELETE en la tabla 'permisos'
DROP TRIGGER IF EXISTS tr_permisos_audit_delete;
GO

CREATE TRIGGER tr_permisos_audit_delete
ON permisos
AFTER DELETE
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        created_at
    )
    SELECT
        SYSTEM_USER,
        'DELETE',
        'permisos',
        id,
        GETDATE()
    FROM deleted;
END;
GO

-- Trigger para UPDATE en la tabla 'permisos'
DROP TRIGGER IF EXISTS tr_permisos_audit_update;
GO

CREATE TRIGGER tr_permisos_audit_update
ON permisos
AFTER UPDATE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        affected_columns,
        old_value,
        new_value,
        created_at
    )
    SELECT
        SYSTEM_USER,
        'UPDATE',
        'permisos',
        i.id,
        'nombre',
        d.nombre,
        i.nombre,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.nombre <> d.nombre 
        OR (i.nombre IS NULL AND d.nombre IS NOT NULL)
        OR (i.nombre IS NOT NULL AND d.nombre IS NULL)

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'permisos',
        i.id,
        'descripcion',
        d.descripcion,
        i.descripcion,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.descripcion <> d.descripcion 
        OR (i.descripcion IS NULL AND d.descripcion IS NOT NULL)
        OR (i.descripcion IS NOT NULL AND d.descripcion IS NULL);
END;
GO

-- Trigger para INSERT en la tabla 'user_permisos'
DROP TRIGGER IF EXISTS tr_user_permisos_audit_insert;
GO

CREATE TRIGGER tr_user_permisos_audit_insert
ON user_permisos
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        created_at
    )
    SELECT 
        SYSTEM_USER,
        'INSERT',
        'user_permisos',
        inserted.id,    
        GETDATE()
    FROM inserted;
END;
GO

-- Trigger para DELETE en la tabla 'user_permisos'
DROP TRIGGER IF EXISTS tr_user_permisos_audit_delete;
GO

CREATE TRIGGER tr_user_permisos_audit_delete
ON user_permisos
AFTER DELETE
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        created_at
    )
    SELECT
        SYSTEM_USER,
        'DELETE',
        'user_permisos',
        id,
        GETDATE()
    FROM deleted;
END;
GO


-- Trigger para UPDATE en la tabla 'user_permisos'
DROP TRIGGER IF EXISTS tr_user_permisos_audit_update;
GO

CREATE TRIGGER tr_user_permisos_audit_update
ON user_permisos
AFTER UPDATE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        affected_columns,
        old_value,
        new_value,
        created_at
    )
    SELECT
        SYSTEM_USER,
        'UPDATE',
        'user_permisos',
        i.id,
        'user_id',
        CAST(d.user_id AS NVARCHAR),
        CAST(i.user_id AS NVARCHAR),
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.user_id <> d.user_id 

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'user_permisos',
        i.id,
        'permiso_id',
        CAST(d.permiso_id AS NVARCHAR),
        CAST(i.permiso_id AS NVARCHAR),
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.permiso_id <> d.permiso_id 

    UNION ALL

    SELECT
        SYSTEM_USER,
        'UPDATE',
        'user_permisos',
        i.id,
        'active',
        CAST(d.active AS NVARCHAR),
        CAST(i.active AS NVARCHAR),
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.active <> d.active;
END;
GO


-- Trigger para INSERT en la tabla 'security_questions'
DROP TRIGGER IF EXISTS tr_security_questions_audit_insert;
GO

CREATE TRIGGER tr_security_questions_audit_insert
ON security_questions
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        created_at
    )
    SELECT 
        SYSTEM_USER,
        'INSERT',
        'security_questions',
        inserted.id,    
        GETDATE()
    FROM inserted;
END;
GO

-- Trigger para DELETE en la tabla 'security_questions'
DROP TRIGGER IF EXISTS tr_security_questions_audit_delete;
GO

CREATE TRIGGER tr_security_questions_audit_delete
ON security_questions
AFTER DELETE
AS
BEGIN
    SET NOCOUNT ON;
    
    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        created_at
    )
    SELECT
        SYSTEM_USER,
        'DELETE',
        'security_questions',
        id,
        GETDATE()
    FROM deleted;
END;
GO

-- Trigger para UPDATE en la tabla 'security_questions'
DROP TRIGGER IF EXISTS tr_security_questions_audit_update;
GO

CREATE TRIGGER tr_security_questions_audit_update
ON security_questions
AFTER UPDATE
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO audit_logs (
        user_type,
        action_type,
        table_name,
        record_id,
        affected_columns,
        old_value,
        new_value,
        created_at
    )
    SELECT
        SYSTEM_USER,
        'UPDATE',
        'security_questions',
        i.id,
        'question',
        d.question,
        i.question,
        GETDATE()
    FROM inserted i
    INNER JOIN deleted d ON i.id = d.id
    WHERE i.question <> d.question;
END;
GO

	