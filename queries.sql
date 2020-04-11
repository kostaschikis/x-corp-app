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
    

-- The Actinlogist Allocation Algorithm
-- 1. Find Max
SELECT `actinologist`, count(actinologist) as totalcount FROM appointment GROUP BY `actinologist` ORDER BY `totalcount` DESC
MAX = arr[1]

function deside_query() {
    foreach(actinologist in actinologists) {
        if (actinologist[i] != max) {
            return false 
        } else {
            return true
        }
    }
}

if deside_query() == true {
    MAX = the number in ()
    do_query(SELECT * FROM `actinologist`)
} else deside_query() == false {
    do_query(SELECT `actinologist` FROM (SELECT `actinologist`, count(*) AS totalcount FROM appointment GROUP BY `actinologist`) as subquery WHERE totalcount < MAX)

    -- -- <Alternative>
    SELECT `name`, `last_name` FROM actinologist INNER JOIN (SELECT `actinologist`, count(*) AS totalcount FROM appointment GROUP BY `actinologist`) as subquery ON actinologist.email = subquery.actinologist
    -- -- </Alternative>

    -- Store The Number of Appointments per Actinologist
    do_query(SELECT `name`, `last_name`, `email` FROM `actinologist` WHERE `email` = `$email`)  
}