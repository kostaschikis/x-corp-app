-- View : Doctor
SELECT `id`, `priority`, `approval` FROM `actinology_requests` WHERE doctor = `get(doctor_email)`

-- View : Actinology Center Index View
SELECT `id`, `priority`, `date_sent`, `approval` FROM `actinology_requests`

-- View : Actinology Center Make Appointment View
SELECT `patient_ssn` FROM `actinology_requests` WHERE id = `get(id)`

SELECT `name`, `last_name` FROM `patient` WHERE patient_ssn = `$patient_ssn`

    -- Get MAX
    SELECT `actinologist` FROM appointment GROUP BY `actinologist` ORDER BY COUNT(*) DESC LIMIT 1

    SELECT `actinologist`, count(*) From appointment Group By actinologist
                                                     WHERE count(*) < MAX 

-- View : Actinologist Index View
SELECT `id`, `exam_date` FROM appointment 

-- View : Actinologist Details View
SELECT `patient_ssn` FROM appointment WHERE appointment.id = `$appointmentId`
   SELECT * FROM patient WHERE patient_ssn = `$patient_ssn`  

SELECT `request_id` FROM appointment WHERE appointment.id = `$appointmentId`
    SELECT `id`, `appointmentId`, `description` FROM actinology_requests WHERE id = `$request_id`