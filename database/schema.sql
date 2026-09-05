CREATE TABLE user_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    error_message TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE employees (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    branch_id INT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM("Male","Female") NOT NULL,
    marital_status ENUM("Single","Married"),
    religion ENUM("Christian","Islamic","N/a"),
    bank Enum("Standard Bank","National Bank","New Building Society","First Discount House","First Capital Bank","Eco Bank","Centenary Bank"),
    bank_account_number VARCHAR(255),
    tenure ENUM("Full-time","Part-time") NOT NULL,
    hired_at DATETIME NOT NULL,
    terminated_at DATETIME,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (branch_id) REFERENCES branch(id)
)

CREATE TABLE attendance(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    status ENUM("Present","Absent","Late","Leave"),
    clock_int DATETIME NOT NULL,
    clock_out DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
)

CREATE TABLE sales(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    branch_id INT NOT NULL,
    employee_id INT NOT NULL,
    opening_units FLOAT NOT NULL,
    closing_units FLOAT NOT NULL,
    used_units FLOAT NOT NULL,
    miller INT,
    sheller INT,
    total_daily INT,
    unit_price INT,
    remarks TEXT,
    created_at DATETIME NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (branch_id) REFERENCES branch(id),
    FOREIGN KEY (employee_id) REFERENCES employees(id)
)