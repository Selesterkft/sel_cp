SELECT Inv_Num         AS 'SzlaSzam'
	  ,Inv_SeqNum      AS 'Iktatosorszam'
	  ,ACCT_Periods_ID AS 'Period'
	  ,TypeID          AS 'TipusID'
	  ,Ref_Inv_ID      AS 'Ref_Szamlak_ID'
	  ,'??'            AS 'Cancellation_ReasonCode'
	  ,Cust_Name1 + ' ' + Cust_Name2 AS 'Cust_Name'
	  ,Cust_Country   + Cust_State   + Cust_ZIP   + Cust_City   + Cust_Addr AS 'Cust_Address'
	  ,Vendor_Country + Vendor_State + Vendor_ZIP + Vendor_City + Vendor_Addr AS 'Vendor_Address'
	  ,Cust_BankCode + Cust_BankAcc AS 'VevoPenzforgJelz'
	  ,'??' AS 'BankCode'
	  ,'??' AS 'Szlaszam'
	  ,'??' AS 'ClassID'
	  ,CAST(Period_FROM AS varchar) + '-' + CAST(Period_TO AS varchar) AS 'Period'
	  ,InvDate        AS 'Kelte'
	  ,DeliveryDate   AS 'Teljesitve'
	  ,PaymentMethod  AS 'FizMod'
	  ,DueDate        AS 'Lejarat'
	  ,PostInDate     AS 'BeerkezesDatum'
	  ,Netto_LC       AS 'NettoOsszesen'      --Nettó összesen könyvelési devizában (rendszerint ez HUF)
	  ,Tax_LC         AS 'AFAOsszesen'
	  ,Brutto_LC      AS 'BruttoOsszesen'
	  -- Jelen pillanatban 1, 3, 5 -ös értke van a mezőnek
	  ,PayStatus      AS 'FizAllapot'         --Bizonylat fizetési állapota ("Fizetve", "Nyitott")
	  ,Fully_paid_date
	  ,PaidAmount_DC  AS 'EddigKifizetve'     --Eddig kifizetve (számla devizanemében megjelölve)
	  ,PaidAmount_FC  AS 'EddigKifizetveEUR'
	  ,PaidAmount_LC  AS 'EddigKifizetveFIBU' --Eddig kifizetve könyvelési devizában (rendszerint ez HUF)
	  ,Netto_DC       AS 'FWGesamtNetto'      --Nettó összesen (bizonylat devizanemében)
	  ,Tax_DC         AS 'FWGesamtMwSt'       --ÁFA összesen (bizonylat devizanemében)
	  ,Brutto_DC      AS 'FWGesamtBrutto'     --Bruttó összesen (bizonylat devizanemében)
	  ,Curr_DC        AS 'Wahrung'            --Számla pénzneme
	  ,Netto_FC       AS 'EURNetto'
	  ,Tax_FC         AS 'EURMwSt'
	  ,Brutto_FC      AS 'EURBrutto'
	  ,Remarks        AS 'Bemerkung'
	  ,Attachments    AS 'Mellekletek'
	  ,Added_Users_ID AS 'FelvUserID'
	  ,Subcontracted_Services                 --Közvetített szolgáltatás igen(1)/nem(0)
  FROM CUSTOMERPORTAL.dbo.Inv;

  SELECT
	Pos_ID            AS 'PozSzam'
	,'??'             AS 'PosInfo'
	,Rates_ID         AS 'TarifID'
	,Descr            AS 'Megnevezes'
	,Note             AS 'TarifBemerkung'
	,Pcs              AS 'Darab'
	,Unit             AS 'ME'
	,UnitPrice_DC     AS 'Egysegar'       --Egységár (számla devizanemében)
	,Netto_DC         AS 'Netto'          --Tételsor nettó (számla devizanemében)
	,ACCT_TaxCodes_ID AS 'SteuerCode'
	,TaxRate          AS 'AFAKulcs'
	,Tax_DC           AS 'AFA'            --Tételsor ÁFA (számla devizanemében)
	,Brutto_DC        AS 'Brutto'         --Tételsor bruttó (számla devizanemében)
	,UnitPrice_FC2    AS 'FWStkPreis'     --Tételsor egységár (szolgáltatás eredeti devizanemében)
	,'??'             AS 'Curr_FC'	      --Szolgáltatás eredeti deviza neme
	,Netto_FC2        AS 'FWNetto'        --Tételsor nettó (szolgáltatás eredeti devizanemében)
	,Tax_FC2          AS 'FWMwSt'         --Tételsor ÁFA (szolgáltatás eredeti devizanemében)
	,Brutto_FC2       AS 'FWBrutto'       --Tételsor bruttó (szolgáltatás eredeti devizanemében)
	, CAST(Period_FROM as varchar) + '-' + CAST(Period_TO as varchar)
	,Period_FROM      AS 'FROM'
	,Period_TO        AS 'TO'
	,'???'            AS 'Subcontracted_Services'
FROM Inv_L
