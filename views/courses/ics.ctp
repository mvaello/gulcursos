<?php
	header("Content-type: text/calendar");
	header("Pragma: no-cache");
	header("Content-Disposition: attachment; filename=calendario-".$course[0]['Course']['title'].".ics");
	header("Expires: 0");

function emit($txt)
{
	echo "$txt\n";
}

	emit("BEGIN:VCALENDAR");
	emit("VERSION:2.0");
	emit("PRODID:--//Grupo de usuarios de Linux//Calendario de cursos//ES");
	foreach($course[0]['Lecture'] as $lecture)
	{
		if(isset($lecture['date']) && isset($lecture['startingtime']) && isset($lecture['endingtime']))
		{
			$start = getDateFromString($lecture['date']) ."T" . getHourFromString($lecture['startingtime']); // . "Z";
			$end   = getDateFromString($lecture['date']) ."T" . getHourFromString($lecture['endingtime']); // . "Z";

			emit("BEGIN:VEVENT");
			emit("DTSTART:" . $start);
			emit("DTEND:" . $end);
			emit("SUMMARY:" . $lecture['title']);
			emit("DESCRIPTION:". str_replace(array("\n", "\r"), "\\n", $lecture['description']) . "\\n\\nImpartido por: ".$lecture['teacher']/*."\\n\\nLugar: " . $lecture['room']*/);
			emit("LOCATION:" . $lecture['room']);
			emit("END:VEVENT");
		}
	}
	emit("END:VCALENDAR");

        function getHourFromString($str)
        {
                $pattern = "/(\d*):(\d*):00/";
                $hour = "000000";

                if ( preg_match( $pattern, $str, $matches ) )
                {
                list( $_hour, $minute) = array( $matches[1], $matches[2]);
			$hour = $_hour . $minute . "00";
                }
                return $hour;
        }

        function getDateFromString($str)
        {
                $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                                                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

                $pattern = "/(\d*)-(\d*)-(\d*)/";
                $date = "00000000";

                if ( preg_match( $pattern, $str, $matches ) )
                {
 	               list( $year, $month, $day) = array( $matches[1], $matches[2], $matches[3]);
			$date = $year . $month . $day;
                }

                return $date;
        }

?>
