
--
-- PUDIN SAEPUDIN CIAMIS
-- DATABASE TRIGER CREAT UPDATE DELETE VIEW.
-- PHPMYADMIN

CREATE TABLE IF NOT EXISTS `obat` (
  `id_obat` int(11) NOT NULL AUTO_INCREMENT,
  `obat_kode` varchar(100) NOT NULL,
  `obat_nama` varchar(150) NOT NULL,
  `obat_satuan` varchar(20) NOT NULL,
  `obat_stok` int(11) NOT NULL,
  `obat_create` datetime NOT NULL,
  `obat_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_obat`),
  CONSTRAINT `uc_obat_kode` UNIQUE (`obat_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `obat` ADD INDEX(`obat_kode`);

CREATE TABLE IF NOT EXISTS `obatMasuk` (
  `id_om` int(11) NOT NULL AUTO_INCREMENT,
  `om_obatkode` varchar(100) NOT NULL,
  `om_tanggal` date NOT NULL,
  `om_jumlah` int(11) NOT NULL,
  `om_create` datetime NOT NULL,
  `om_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_om`),
  CONSTRAINT `fk_obat_obatmasuk1` FOREIGN KEY (`om_obatkode`) REFERENCES `obat` (`obat_kode`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `obatKeluar` (
  `id_ok` int(11) NOT NULL AUTO_INCREMENT,
  `ok_obatkode` varchar(100) NOT NULL,
  `ok_tanggal` date NOT NULL,
  `ok_jumlah` int(11) NOT NULL,
  `ok_create` datetime NOT NULL,
  `ok_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ok`),
  CONSTRAINT `fk_obat_obatkeluar1` FOREIGN KEY (`ok_obatkode`) REFERENCES `obat` (`obat_kode`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




--
-- /* ----------------------------------------------------------------------------------------------------------- */
-- TRIGER Tambah stok obat saat input data di Obat Masuk
--
-- Pilih table obatMasuk Trigers -> Add Triger 
--
-- Triger Name : TambahStokObat
-- Table : obatMasuk
-- Time : AFTER
-- Event : INSERT
-- Definer : root@localhost
-- Definition :
BEGIN
	UPDATE obat set obat_stok = obat_stok + NEW.om_jumlah
	WHERE obat_kode = NEW.om_obatkode;
END


-- HAPUS / DELETE
-- Ketika barang masuk dihapus, maka otomatis stok obat akan dikurangi sesuai jumlah yang dihapusnya.
-- Triger Name : TambahStokObatDelete
-- Table : obatMasuk
-- Time : AFTER
-- Event : DELETE
-- Definer : root@localhost
-- Definition :
BEGIN
    UPDATE obat SET obat.obat_stok=obat.obat_stok - old.om_jumlah
    WHERE obat.obat_kode= old.om_obatkode;
END

-- UPDATE/EDIT
-- Triger Name : TambahStokObatBeforeUpdate
-- Table : obatMasuk
-- Time : BEFORE
-- Event : UPDATE
-- Definer : root@localhost
-- Definition :
BEGIN
    UPDATE obat SET obat.obat_stok = obat.obat_stok + new.om_jumlah
	WHERE obat.obat_kode = new.om_obatkode;
END

-- Triger Name : TambahStokObatAfterUpdate
-- Table : obatMasuk
-- Time : AFTER
-- Event : UPDATE
-- Definer : root@localhost
-- Definition :
BEGIN
    UPDATE obat SET obat.obat_stok = obat.obat_stok - old.om_jumlah
	WHERE obat.obat_kode = old.om_obatkode;
END


--
--  Mentotalkan Obat masuk dengan SUM dan GROUPBY
--
SELECT om_obatkode, SUM(om_jumlah) as om_jml FROM `obatmasuk`
GROUP BY om_obatkode
--
-- Buat Jadi View
--
CREATE VIEW v_obatmasuk
AS
SELECT om_obatkode, SUM(om_jumlah) as om_jml FROM `obatmasuk`
GROUP BY om_obatkode;


--
-- /* --------------------------------------------------------------------------------------------------------------- */
--
-- TRIGER Kurangi stok daat input di Obat Keluar
--
-- Pilih table obatKeluar Trigers -> Add Triger 
--
-- Triger Name : AmbilStokObat
-- Table : obatKeluar
-- Time : AFTER
-- Event : INSERT
-- Definer : root@localhost
-- Definition :

BEGIN
	UPDATE obat set obat_stok = obat_stok - NEW.ok_jumlah
	WHERE obat_kode = NEW.ok_obatkode;
END

-- HAPUS / DELETE
-- Ketika barang keluar dihapus, maka otomatis stok obat akan bertambah lagi sesuai jumlah yang dihapusnya.
-- Triger Name : AmbilStokObatDelete
-- Table : obatMasuk
-- Time : AFTER
-- Event : DELETE
-- Definer : root@localhost
-- Definition :
BEGIN
    UPDATE obat SET obat.obat_stok=obat.obat_stok + old.ok_jumlah
    WHERE obat.obat_kode= old.ok_obatkode;
END

-- EDIT / UPDATE
-- Triger Name : AmbilStokObatBeforeUpdate
-- Table : obatMasuk
-- Time : BEFORE
-- Event : UPDATE
-- Definer : root@localhost
-- Definition :
BEGIN
    UPDATE obat SET obat.obat_stok = obat.obat_stok - new.ok_jumlah
	WHERE obat.obat_kode = new.ok_obatkode;
END

-- Triger Name : AmbilStokObatAfterUpdate
-- Table : obatMasuk
-- Time : AFTER
-- Event : UPDATE
-- Definer : root@localhost
-- Definition :
BEGIN
    UPDATE obat SET obat.obat_stok = obat.obat_stok + old.ok_jumlah
	WHERE obat.obat_kode = old.ok_obatkode;
END

--
--  Mentotalkan Obat keluar dengan SUM dan GROUPBY
--
SELECT ok_obatkode, SUM(ok_jumlah) as ok_jml FROM `obatkeluar`
GROUP BY ok_obatkode
--
-- Buat Jadi View
--
CREATE VIEW v_obatkeluar
AS
SELECT ok_obatkode, SUM(ok_jumlah) as ok_jml FROM `obatkeluar`
GROUP BY ok_obatkode;



--
-- /* ------------------------------------------------------------------------- */
--
-- VIEW OBAT JOIN berikut obat masuk, obat keluar dan stok tersedianya.
--

CREATE VIEW v_obat
AS
SELECT 
tb1.id_obat, tb1.obat_kode, tb1.obat_nama, tb1.obat_stok, tb1.obat_satuan,
tb2.om_jml,
tb3.ok_jml
FROM obat tb1
LEFT JOIN v_obatmasuk tb2 ON tb1.obat_kode = tb2.om_obatkode
LEFT JOIN v_obatkeluar tb3 ON tb1.obat_kode = tb3.ok_obatkode;


--
-- VIEW JOIN
--

CREATE VIEW v_j_obatmasuk
AS
SELECT 
tb1.id_om, om_obatkode, tb1.om_tanggal, tb1.om_jumlah,
tb2.obat_nama, tb2.obat_satuan
FROM obatmasuk tb1
LEFT JOIN obat tb2 ON tb1.om_obatkode = tb2.obat_kode;

CREATE VIEW v_j_obatkeluar
AS
SELECT 
tb1.id_ok, ok_obatkode, tb1.ok_tanggal, tb1.ok_jumlah,
tb2.obat_nama, tb2.obat_satuan
FROM obatkeluar tb1
LEFT JOIN obat tb2 ON tb1.ok_obatkode = tb2.obat_kode;

--
-- ============================= PUDIN SAEPUDIN CIAMIS https://t.me/pudin_ira ======================================
--
