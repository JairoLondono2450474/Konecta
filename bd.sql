CREATE DATABASE IF NOT EXISTS cafekonecta;

USE cafekonecta;

CREATE TABLE product_tbl(idProduct INT NOT NULL, nameProduct VARCHAR(30) NOT NULL, refProduct VARCHAR(10) NOT NULL, priceProduct INT NOT NULL, weightProduct INT NOT NULL, catProduct VARCHAR(30) NOT NULL, stockProduct INT NOT NULL, creationProduct DATE DEFAULT NOW() NOT NULL, PRIMARY KEY(idProduct));

CREATE TABLE sales_tbl(idProduct_tbl INT NOT NULL, amountSales INT NOT NULL, totalSales INT NOT NULL, FOREIGN key(idProduct_tbl) REFERENCES product_tbl(idProduct));