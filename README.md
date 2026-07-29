# **Afrinance**

## Statistical details and analysis of an enterprise assets and accounting

## **Tech Stack**

* Next JS (React) for web interface
* React Native for mobile interface
* Firestore for database management
* Firebase for authentication

## Features

* Create business profile
* Record assets
* Record transactions (income / expenses)
* Record employees
* Record payroll
* Record earnings
* Record deductions
* Record loans
* Record attendance

## 1. Relational Schema (SQL)

### USERS (auth handled by Firebase, this just stores app-level info)

### users

  user_id         PK
  firebase_uid    UNIQUE       -- links to Firebase Auth, no password stored here
  username
  role            -- 'owner', 'admin', 'employee', etc.
  created_at
  updated_at

### Links users to the companies they can access (many-to-many)

### user_company

  user_company_id PK
  user_id         FK -> users
  company_id      FK -> profile
  role_in_company  -- lets one user have different roles in different companies

### profile  (company)

  company_id      PK
  company_name
  company_mission
  company_logo
  privacy_policy
  currency         -- e.g. MWK, USD
  created_at
  updated_at

### assets  (branch / location / physical asset)

  asset_id        PK
  company_id      FK -> profile
  asset_name
  asset_description
  asset_location
  asset_category   -- fixed asset / inventory / property
  purchase_cost
  current_value
  acquisition_date
  created_at
  updated_at

### employees

  employee_id     PK
  asset_id        FK -> assets       -- which branch they work at
  user_id         FK -> users NULL   -- if employee also logs in
  first_name
  last_name
  date_of_birth
  gender
  marital_status
  religion
  employee_role
  base_salary
  bank_account_number   -- consider encrypting
  bank_name
  employment_type   -- full-time / contract
  hired_at
  terminated_at   NULL
  updated_at

### attendance

  attendance_id   PK
  employee_id     FK -> employees
  status          -- present / absent / late
  location
  clock_in
  clock_out       NULL
  marked_by       FK -> users NULL   -- self or admin

### transactions

  transaction_id  PK
  asset_id        FK -> assets
  employee_id     FK -> employees NULL
  description
  action          -- 'sell' or 'expense'
  category        -- rent, sales, utilities, etc.
  amount
  payment_method   -- cash / bank / mobile money
  currency
  receipt_url     NULL
  transaction_datetime
  updated_at

### payroll_run

  payroll_run_id  PK
  company_id      FK -> profile
  period
  payment_date
  status          -- draft / approved / paid
  description

### earnings

  earning_id      PK
  payroll_run_id  FK -> payroll_run
  employee_id     FK -> employees
  description
  amount

### deductions

  deduction_id    PK
  payroll_run_id  FK -> payroll_run
  employee_id     FK -> employees
  description
  amount

### loans

  loan_id         PK
  employee_id     FK -> employees
  loan_type
  loan_amount
  interest_rate
  balance
  status          -- active / paid / defaulted
  loan_datetime

### loan_repayments

  repayment_id    PK
  loan_id         FK -> loans
  amount
  repayment_datetime

## 2.Firestore (NoSQL)

firestore-root/
│
├── users/{userId}
│     firebase_uid: "abc123"
│     username: "jdoe"
│     role: "owner"
│     created_at, updated_at
│
├── companies/{companyId}
│     company_name: "Afrinance Traders"
│     company_mission: "..."
│     company_logo: "url"
│     privacy_policy: "url"
│     currency: "MWK"
│     owners: ["userId1", "userId2"]     -- array for quick membership checks
│     created_at, updated_at
│
│     └── members/{userId}                -- subcollection: who can access this company
│           role_in_company: "admin"
│           added_at
│
│     └── assets/{assetId}                -- subcollection: assets always queried per company
│           asset_name: "Blantyre Branch"
│           asset_location: "..."
│           category: "fixed_asset"
│           purchase_cost: 5000000
│           current_value: 4200000
│           acquisition_date
│           created_at, updated_at
│
│           └── transactions/{transactionId}   -- subcollection: transactions per asset
│                 employee_id: "empId"
│                 employee_name: "John Banda"   -- denormalized for display without extra read
│                 description: "..."
│                 action: "sell"
│                 category: "sales"
│                 amount: 15000
│                 payment_method: "mobile_money"
│                 transaction_datetime
│                 updated_at
│
│     └── employees/{employeeId}          -- subcollection: employees per company
│           asset_id: "assetId"
│           asset_name: "Blantyre Branch"   -- denormalized
│           first_name, last_name
│           date_of_birth, gender, marital_status, religion
│           employee_role: "Cashier"
│           base_salary: 250000
│           bank_account_number, bank_name
│           employment_type: "full_time"
│           hired_at
│           terminated_at: null
│           updated_at
│
│           └── attendance/{attendanceId}  -- subcollection: attendance per employee
│                 status: "present"
│                 location: "..."
│                 clock_in, clock_out
│                 marked_by: "userId"
│
│           └── loans/{loanId}             -- subcollection: loans per employee
│                 loan_type: "salary_advance"
│                 loan_amount: 100000
│                 interest_rate: 0.05
│                 balance: 60000
│                 status: "active"
│                 loan_datetime
│
│                 └── repayments/{repaymentId}
│                       amount: 20000
│                       repayment_datetime
│
│     └── payroll_runs/{payrollRunId}      -- subcollection: payroll per company
│           period: "2026-06"
│           payment_date
│           status: "approved"
│           description
│
│           └── earnings/{earningId}
│                 employee_id: "empId"
│                 employee_name: "John Banda"  -- denormalized
│                 description: "Base salary"
│                 amount: 250000
│
│           └── deductions/{deductionId}
│                 employee_id: "empId"
│                 employee_name: "John Banda"
│                 description: "Loan repayment"
│                 amount: 20000