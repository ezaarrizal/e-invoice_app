-- ==============================
-- PostgreSQL version of invoice_db.sql
-- Only includes: items, invoices, invoice_items
-- ==============================

-- Drop tables if exist
DROP TABLE IF EXISTS invoice_items CASCADE;
DROP TABLE IF EXISTS invoices CASCADE;
DROP TABLE IF EXISTS items CASCADE;

-- ==============================
-- Table: items
-- ==============================
CREATE TABLE items (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    hpj NUMERIC(15, 2) DEFAULT 0,  -- Harga Pokok Jual
    hpb NUMERIC(15, 2) DEFAULT 0,  -- Harga Pokok Beli
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================
-- Table: invoices
-- ==============================
CREATE TABLE invoices (
    id BIGSERIAL PRIMARY KEY,
    invoice_number VARCHAR(50) UNIQUE,  -- Format: 0001/2025
    customer_name VARCHAR(255) NOT NULL,
    invoice_date DATE NOT NULL,
    type VARCHAR(10) CHECK (type IN ('HPJ', 'HPB', 'HPF')),
    total NUMERIC(15, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================
-- Table: invoice_items
-- ==============================
CREATE TABLE invoice_items (
    id BIGSERIAL PRIMARY KEY,
    invoice_id BIGINT NOT NULL REFERENCES invoices(id) ON DELETE CASCADE,
    item_id BIGINT NOT NULL REFERENCES items(id) ON DELETE CASCADE,
    quantity INT DEFAULT 1,
    price NUMERIC(15, 2) DEFAULT 0,
    subtotal NUMERIC(15, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==============================
-- Optional: sample data (hapus kalau tidak perlu)
-- ==============================
INSERT INTO items (name, hpj, hpb) VALUES
('Kain Batik', 100000, 75000),
('Kemeja Pria', 120000, 90000),
('Blus Wanita', 95000, 70000);

-- ==============================
-- Done
-- ==============================
