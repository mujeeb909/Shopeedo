ALTER TABLE `refund_requests` ADD `reject_reason` LONGTEXT NULL DEFAULT NULL AFTER `refund_status`;

COMMIT;
