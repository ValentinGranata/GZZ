CREATE TABLE IF NOT EXISTS User (
    id              INTEGER                     PRIMARY KEY AUTO_INCREMENT,
    email           VARCHAR(320)    NOT NULL    UNIQUE,
    password        VARCHAR(255)    NOT NULL,
    name            VARCHAR(50)     NOT NULL,
    surname         VARCHAR(50)     NOT NULL,
    token           VARCHAR(255),
    profile_picture VARCHAR(255),
    created_at      TIMESTAMP       DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Startup (
    id          INTEGER                     PRIMARY KEY AUTO_INCREMENT,
    title       VARCHAR(50)     NOT NULL,
    description TEXT            NOT NULL,
    category    VARCHAR(50)     NOT NULL,
    email       VARCHAR(320)    NOT NULL    UNIQUE,
    owner_id    INTEGER         NOT NULL,
    banner      VARCHAR(255),
    created_at  TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_startup_owner
        FOREIGN KEY (owner_id)
        REFERENCES User(id)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Interaction (
    id          INTEGER                             PRIMARY KEY AUTO_INCREMENT,
    startup_id  INTEGER         NOT NULL,
    user_id     INTEGER         NOT NULL,
    type        ENUM('like', 'repost', 'save') NOT NULL,
    created_at  TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_interaction_startup
        FOREIGN KEY (startup_id)
        REFERENCES Startup(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_interaction_user
        FOREIGN KEY (user_id)
        REFERENCES User(id)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Investment (
    id          INTEGER                             PRIMARY KEY AUTO_INCREMENT,
    investor_id INTEGER         NOT NULL,
    startup_id  INTEGER         NOT NULL,
    percentage  DECIMAL(5,2)    NOT NULL,
    amount      DECIMAL(10,2)   NOT NULL,
    status      ENUM('pending', 'accepted', 'rejected') NOT NULL,
    message     VARCHAR(255),
    created_at  TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_investment_investor
        FOREIGN KEY (investor_id)
        REFERENCES User(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_investment_startup
        FOREIGN KEY (startup_id)
        REFERENCES Startup(id)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Comment (
    id          INTEGER                             PRIMARY KEY AUTO_INCREMENT,
    owner_id    INTEGER         NOT NULL,
    startup_id  INTEGER         NOT NULL,
    message     VARCHAR(255),
    created_at  TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_comment_owner
        FOREIGN KEY (owner_id)
        REFERENCES User(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_comment_startup
        FOREIGN KEY (startup_id)
        REFERENCES Startup(id)
        ON DELETE CASCADE
);