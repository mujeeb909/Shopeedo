INSERT INTO `otp_configurations` (`id`, `type`, `value`, `created_at`, `updated_at`) 
    SELECT NULL, 'sparrow', '0', current_timestamp(), current_timestamp() FROM DUAL 
    WHERE NOT EXISTS (SELECT * FROM `otp_configurations` WHERE `type`='sparrow' LIMIT 1);

INSERT INTO `otp_configurations` (`id`, `type`, `value`, `created_at`, `updated_at`) 
    SELECT NULL, 'zender', '0', current_timestamp(), current_timestamp() FROM DUAL 
    WHERE NOT EXISTS (SELECT * FROM `otp_configurations` WHERE `type`='zender' LIMIT 1);
	
DELETE FROM `otp_configurations` WHERE `type` = 'otp_for_order';
DELETE FROM `otp_configurations` WHERE `type` = 'otp_for_delivery_status';
DELETE FROM `otp_configurations` WHERE `type` = 'otp_for_paid_status';

COMMIT;
