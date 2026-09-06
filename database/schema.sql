CREATE TABLE user_logs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE employees(
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

CREATE TABLE expenses(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    branch_id INT NOT NULL,
    employee_id INT NOT NULL,
    expense_type ENUM("Electricity","Lunch","Water","Overtime","Bulb","Broom","Welding","Spares","Maintenance","Malichelo","Buckets","Neighborhood","Other") NOT NULL,
    description TEXT,
    quantity INT NOT NULL,
    amount INT NOT NULL,
    created_at DATE NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (branch_id) REFERENCES branch(id),
    FOREIGN KEY (employee_id) REFERENCES employees(id)
)

CREATE TABLE payroll(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    branch_id INT,
    period DATE NOT NULL,
    payment_date DATE NOT NULL,
    description ENUM("Salary","Bonus","Pension","Termination"),
    created_at DATETIME NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (branch_id) REFERENCES branch(id)
)

CREATE TABLE earnings(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    payroll_id INT NOT NULL,
    employee_id INT NOT NULL,
    remarks TEXT,
    amount INT NOT NULL,
    FOREIGN KEY (payroll_id) REFERENCES payroll(id)
)

CREATE TABLE deductions(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    payroll_id INT NOT NULL,
    employee_id INT NOT NULL,
    remarks TEXT,
    amount INT NOT NULL,
    FOREIGN KEY (payroll_id) REFERENCES payroll(id)
)

CREATE TABLE loans(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    payback_period ENUM("Monthly","Quarterly","Annually") NOT NULL,
    amount INT NOT NULL,
    interest_rate INT NOT NULL,
    balance INT NOT NULL,
    status ENUM("Active","Paid","Defaulted"),
    created_at DATETIME NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id)
)

CREATE TABLE loan_repayments(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    loan_id INT NOT NULL,
    amount INT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (loan_id) REFERENCES loans(id)
)