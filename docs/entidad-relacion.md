erDiagram
    %% ==========================================
    %% 1. AUTENTICACIÓN Y AUTORIZACIÓN
    %% ==========================================
    users {
        bigint id PK
        string email UK
        string department
        string avatar
        softDeletes
    }
    permissions {
        bigint id PK
        string name
        string guard_name
    }
    roles {
        bigint id PK
        string name
        string guard_name
        bigint team_id FK
    }
    model_has_permissions {
        bigint permission_id PK,FK
        string model_type PK
        bigint model_id PK
        bigint team_id FK
    }
    model_has_roles {
        bigint role_id PK,FK
        string model_type PK
        bigint model_id PK
        bigint team_id FK
    }
    role_has_permissions {
        bigint permission_id PK,FK
        bigint role_id PK,FK
    }

    %% ==========================================
    %% 2. CONTENIDO
    %% ==========================================
    categories {
        bigint id PK
        string name
        string slug UK
        string color
        softDeletes
    }
    posts {
        bigint id PK
        bigint user_id FK
        bigint category_id FK
        string title
        string slug UK
        enum status
        bigint view_count
        boolean shared_to_social
        softDeletes
    }
    pages {
        bigint id PK
        string title
        string slug UK
        text content
        boolean is_published
    }
    slides {
        bigint id PK
        string title
        string image
        string link
        integer order
        boolean is_active
    }
    events {
        bigint id PK
        bigint user_id FK
        string title
        string slug UK
        longText description
        datetime starts_at
        boolean is_featured
        enum status
        bigint view_count
        softDeletes
    }
    media {
        bigint id PK
        string model_type
        bigint model_id
        uuid uuid UK
        string collection_name
        string file_name
        string disk
        bigint size
    }
    achievements {
        bigint id PK
        bigint user_id FK
        string title
        string slug UK
        string area
        date achieved_at
        enum status
        softDeletes
    }
    galleries {
        bigint id PK
        bigint user_id FK
        string title
        string slug UK
        enum type
        date event_date
        boolean is_featured
        enum status
        softDeletes
    }
    gallery_items {
        bigint id PK
        bigint gallery_id FK
        string type
        string image_path
        string video_url
        integer sort_order
    }

    %% ==========================================
    %% 3. NAVEGACIÓN
    %% ==========================================
    menus {
        bigint id PK
        string name
        string location UK
        boolean is_active
    }
    menu_items {
        bigint id PK
        bigint menu_id FK
        bigint parent_id FK
        string label
        string url
        bigint page_id FK
        string target
        integer order
        boolean is_active
    }

    %% ==========================================
    %% 4. CONFIGURACIÓN
    %% ==========================================
    site_settings {
        bigint id PK
        string key UK
        text value
    }
    external_systems {
        bigint id PK
        string name
        string url
        boolean is_active
        enum last_status
        integer order
    }

    %% ==========================================
    %% 5. ACTIVIDAD
    %% ==========================================
    activity_log {
        bigint id PK
        string log_name
        text description
        string subject_type
        bigint subject_id
        string causer_type
        bigint causer_id
        json properties
    }

    %% ==========================================
    %% 6. AUTORIDADES Y SECRETARÍAS
    %% ==========================================
    officials {
        bigint id PK
        bigint user_id FK
        bigint parent_id FK
        bigint secretariat_id FK
        string name
        string position
        string area
        tinyint position_level
        boolean is_active
        softDeletes
    }
    secretariats {
        bigint id PK
        bigint parent_secretariat_id FK
        bigint head_official_id FK
        string name
        string slug UK
        string acronym
        text mission
        text vision
        string color
        integer sort_order
        boolean is_active
        softDeletes
    }

    %% ==========================================
    %% 7. SERVICIOS AL CIUDADANO
    %% ==========================================
    procedures {
        bigint id PK
        string code UK
        string name
        string slug UK
        enum category
        bigint responsible_secretariat_id FK
        bigint responsible_official_id FK
        boolean is_online
        enum status
        boolean is_featured
        integer sort_order
        softDeletes
    }
    offices {
        bigint id PK
        string name
        string address
        string municipality
        string phone
        string email
        decimal latitude
        decimal longitude
        json services
        boolean is_active
        integer sort_order
        softDeletes
    }
    announcements {
        bigint id PK
        string code UK
        enum type
        string title
        string slug UK
        date publication_date
        datetime opening_date
        datetime closing_date
        enum status
        bigint responsible_secretariat_id FK
        softDeletes
    }
    complaints {
        bigint id PK
        enum type
        string code UK
        string full_name
        string ci
        string email
        string subject
        longText description
        bigint related_secretariat_id FK
        enum status
        longText response
        bigint assigned_to FK
        string tracking_token UK
        string ip_address
        softDeletes
    }

    %% ==========================================
    %% 8. TRANSPARENCIA
    %% ==========================================
    infrastructure_projects {
        bigint id PK
        bigint user_id FK
        bigint secretariat_id FK
        bigint gallery_id FK
        string code UK
        string title
        string slug UK
        string category
        string municipality
        json beneficiary_communities
        decimal latitude
        decimal longitude
        enum status
        boolean is_featured
        decimal budget
        tinyint progress_percentage
        softDeletes
    }
    departmental_statistics {
        bigint id PK
        year year UK
        integer population
        decimal gdp_billion_usd
        integer schools
        integer hospitals
        bigint user_id FK
        softDeletes
    }
    marco_normativos {
        bigint id PK
        enum type
        string number
        string title
        string slug UK
        date issue_date
        enum scope
        boolean is_published
        integer sort_order
        softDeletes
    }
    open_datasets {
        bigint id PK
        string title
        string slug UK
        string category
        enum update_frequency
        date last_updated_at
        json formats
        string license
        string file_csv
        string file_json
        string file_xlsx
        string file_pdf
        boolean is_published
        integer sort_order
        integer download_count
        softDeletes
    }

    %% ==========================================
    %% 9. GESTIÓN
    %% ==========================================
    agendas {
        bigint id PK
        bigint user_id FK
        string title
        string slug UK
        date date
        time time
        string location
        boolean is_public
        string status
        softDeletes
    }
    post_templates {
        bigint id PK
        string name
        string type
        json default_data
        boolean is_active
    }
    contact_messages {
        bigint id PK
        string name
        string email
        string subject
        text message
        boolean is_read
    }

    %% ==========================================
    %% 10. SISTEMA LARAVEL
    %% ==========================================
    password_reset_tokens {
        string email PK
        string token
        timestamp created_at
    }
    sessions {
        string id PK
        bigint user_id FK
        string ip_address
        text user_agent
        longText payload
        integer last_activity
    }
    cache {
        string key PK
        longText value
        integer expiration
    }
    jobs {
        bigint id PK
        string queue
        longText payload
        tinyint attempts
        int reserved_at
        int available_at
        int created_at
    }

    %% ==========================================
    %% RELACIONES (CARDINALIDAD)
    %% ==========================================
    
    %% Auth
    users ||--o{ model_has_roles : "tiene"
    roles ||--o{ model_has_roles : "asignado a"
    roles ||--o{ role_has_permissions : "posee"
    permissions ||--o{ role_has_permissions : "otorgado a"
    users ||--o{ model_has_permissions : "tiene"
    permissions ||--o{ model_has_permissions : "asignado a"

    %% Contenido
    users ||--o{ posts : "crea"
    categories ||--o{ posts : "clasifica"
    users ||--o{ events : "crea"
    users ||--o{ achievements : "registra"
    users ||--o{ galleries : "crea"
    galleries ||--o{ gallery_items : "contiene"
    users ||--o{ agendas : "crea"

    %% Navegación
    menus ||--o{ menu_items : "contiene"
    menu_items ||--o{ menu_items : "subítem de"
    pages ||--o{ menu_items : "enlaza a"

    %% Autoridades y Secretarías
    secretariats ||--o{ officials : "emplea"
    officials ||--o{ officials : "reporta a"
    secretariats ||--o{ secretariats : "subordinada de"
    officials ||--o{ secretariats : "dirige"
    users ||--o{ officials : "vinculado a"

    %% Servicios
    secretariats ||--o{ procedures : "responsable de"
    officials ||--o{ procedures : "responsable de"
    secretariats ||--o{ announcements : "publica"
    secretariats ||--o{ complaints : "recibe"
    users ||--o{ complaints : "asignado a"

    %% Transparencia
    users ||--o{ infrastructure_projects : "gestiona"
    secretariats ||--o{ infrastructure_projects : "responsable de"
    galleries ||--o{ infrastructure_projects : "documenta"
    users ||--o{ departmental_statistics : "registra"

    %% Media Polimórfico
    posts ||--o{ media : "tiene"
    users ||--o{ media : "tiene"
    galleries ||--o{ media : "tiene"
