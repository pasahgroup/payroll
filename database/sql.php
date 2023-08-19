ALTER TABLE `tax_rule` CHANGE `amount` `amount` DOUBLE(10,2) NOT NULL,
 CHANGE `percentage_of_tax` `percentage_of_tax`
  DOUBLE(10,2) NOT NULL, CHANGE `amount_of_tax`
  `amount_of_tax` DOUBLE(10,2) NOT NULL;
