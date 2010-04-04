<?php
	class WidewisseHelper extends AppHelper{
		function votes($lecture,$with_zero=false){
			$total_votes = 0;
			if(isset($lecture['Vote'])){
				$total_votes = count($lecture['Vote']);
			}
			if($total_votes==0 && !$with_zero){ return ""; }
			else{ return $total_votes; }
		}	

		function votesclass($lecture){
			$votes = $this->votes($lecture);
			if($marks<0){ return "bad"; }
			elseif($marks>0){ return "good"; }
			else{ return "zero"; }
		}

		function marks($lecture){
			$totalMark=0;
			if(isset($lecture['Vote'])){
				foreach($lecture['Vote'] as $vote) {
					$totalMark += $vote['mark'];
				}
			}
			if($totalMark==0){ return ''; }
			else{ return $totalMark; }
		}

		function comments($lecture){
			$totalComments=0;
			if(isset($lecture['Comment'])){
				$totalComments = count($lecture['Comment']);
			}
			if($totalComments==0){ return ''; }
			else{ return $totalComments; }
		}

		function markclass($lecture){
			$marks = $this->marks($lecture);
			if($marks<0){ return "bad"; }
			elseif($marks>0){ return "good"; }
			else{ return "zero"; }
		}

		function pupils($lecture){
			$total_pupils = 0;
			if(isset($lecture['Pupil'])){
				$total_pupils = count($lecture['Pupil']);
			}
			if($total_pupils==0){ return ""; }
			else{ return $total_pupils; }
		}

		function period($begin,$end){
			$result = substr($begin,0,5)." - ".substr($end,0,5);
			if($result==" - "){ return ""; }
			else{ return $result; }
		}

		function date($date){
			$splited_date = split("-",$date);
			if(count($splited_date)==3){
				return $splited_date[2]."/".$splited_date[1]."/".$splited_date[0];
			}else{ return ""; }
		}

		function createCalendar($course, $html, $assistants)
		{	
			$OUT_HTML="";
		
			$filteredLectures = array();
			$skippedLectures = array();
		
			/* diferenciamos entre las charlas con datos (fecha y hora) y las charlas sin datos */
		
			foreach($course['Lecture'] as $lecture)
			{
				if (isset($lecture['date']) && isset($lecture['startingtime']) && isset($lecture['endingtime']))
				{
					$filteredLectures[sizeof($filteredLectures)] = $lecture;
				}
				else
				{
					$skippedLectures[sizeof($skippedLectures)] = $lecture;
				}
			}
			
			/* nos quedamos con las charlas con datos */
		
			$course['Lecture'] = $filteredLectures;
			
			/* empiezan los malabares con las fechas */
		
			/* buscar los dias inicial y final del calendario */
		
			$firstDateStr = $course['Lecture'][0]['date'];
			$nDates = sizeof($course['Lecture']);
			$lastDateStr = $course['Lecture'][$nDates-1]['date'];
			
			/* sacar un monton de datos de cada fecha (getDateFromString devuelve un array de valores) */
		
			$firstDate = $this->getDateFromString($firstDateStr);
			$lastDate = $this->getDateFromString($lastDateStr);
			
			$firstWeek = 0;
			$nWeeks = 0;
			$i = 0;
			
			/* cada lecture se complementa con informacion adicional: semana, dia de la semana, etc. */
		
			foreach($course['Lecture'] as $lecture)
			{
					$date = $this->getDateFromString($lecture['date']);
					$lecture['dayofweek'] = $date['dayofweek'];
			
					if ($lecture['id'] == $course['Lecture'][0]['id'])
						$firstWeek = $date['week'];
			
					$lecture['week'] = $date['week'] - $firstWeek;	
					$lecture['beautifuldate'] = $date['beautifuldate'];
					$course['Lecture'][$i++] = $lecture;
			
					$nWeeks = $lecture['week']; // supone la lista ordenada
			}
		
			$day = 0;
			$lastDay = -1;
			$nLecturesInThatDay = 0;
			$i = 0;
			$theCalendar = array();
			
			/* segundo paso: rellenamos el array del calendario. Los malabares vienen con los fines de semana y esas cosas */
		
			foreach($course['Lecture'] as $lecture)
			{
				$day = $lecture['week'] * 7 + $lecture['dayofweek'];
		
				if ($day > $lastDay)
				{
					$daysToFill = ($day - $lastDay) - 1;
		
					for ($d = 0; $d < $daysToFill; $d++)
					{
						$theCalendar[$lastDay + $d + 1] = array(array());
					}
					
					$lastDay = $day;
					$nLecturesInThatDay = 0;
				}
		
				$theCalendar[$day][$nLecturesInThatDay] = $lecture;
				
				$nLecturesInThatDay++;		
				$i++;
			}
			
			/* solo queda pintarlo bonito */
		
			$dayOfWeek = 0;
			$daynames = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes');
			
			$OUT_HTML .= "<table class='calendar'> <tbody>\n";
			$OUT_HTML .=  "  <tr>\n";
			foreach($daynames as $name)
				$OUT_HTML .=  "    <th>$name</th>\n";
			$OUT_HTML .=  "  <tr>\n";
		
			foreach($theCalendar as $lecturesInDay)
			{	
					if ($dayOfWeek % 7 == 0) $OUT_HTML .=  "  <tr>\n";
					
					if (($dayOfWeek % 7 < 5))
					{
						$OUT_HTML .=  "    <td>\n";
						$OUT_HTML .=  "<table class='subcalendar'><tbody>";
						
						if (sizeof($lecturesInDay) > 0 && sizeof($lecturesInDay[0]) > 0)
						{
							$OUT_HTML .=  "  <tr><th colspan='2'> " . $lecturesInDay[0]['beautifuldate'] . "</th> </tr>";	
						}
						
						foreach($lecturesInDay as $lecture)
						{
							if (sizeof($lecture) > 0)
							{
								$class = "";
								
								if ($assistants)
								{
									$class = strlen($lecture['assistedby']) > 0? "-assisted" : "-unassisted";
								}
														
								$OUT_HTML .=  "<tr><td class='time'>";
								$OUT_HTML .=  substr($lecture['startingtime'], 0, strlen($lecture['startingtime']) - 3);
								$OUT_HTML .=  "</td><td class='talk$class'>";
								
								$tooltip   = "Ponente: " . $lecture['teacher'] . " | ";
								$tooltip  .= "Aula: " . $lecture['room'] . " | ";
								$tooltip  .= "Asistido por: " . $lecture['assistedby'];
								
								$OUT_HTML .=  $html->link($lecture['title'], "/lectures/view/".$lecture['id'], array('title' => $tooltip));
								
								$OUT_HTML .=  "</td></tr>";
							}
						}
						$OUT_HTML .=  "</tbody></table>";
						$OUT_HTML .=  "    </td>\n";
					}
					if ($dayOfWeek % 7 == 5) $OUT_HTML .=  "  </tr>\n";
				
				$dayOfWeek++;
			}
			$OUT_HTML .=  "</tbody></table>\n";
			
			if (sizeof($skippedLectures) > 0)
			{
				$OUT_HTML .= "<p>\n  NOTA: este calendario no incluye las siguientes charlas:";
				$OUT_HTML .= "  <ul>";
				foreach($skippedLectures as $lecture)
				{
					$OUT_HTML .= "    <li>".$html->link($lecture['title'], "/lectures/view/".$lecture['id'])."</li>";
				}
				$OUT_HTML .= "  </ul>";
				$OUT_HTML .= "  La razón es que no disponemos de la fecha y hora exactas. 
				Probablemente estén en plena organización. </p>";
				
			}
		
			return $OUT_HTML;
		}

		private function getHourFromString($str)
		{
			$pattern = "/(\d*):(\d*):00/";
			$hour = array();
		    
			if ( preg_match( $pattern, $str, $matches ) )
			{
		        list( $_hour, $minute) = array( $matches[1], $matches[2]);
				$hour['hour'] = $_hour;
				$hour['minute'] = $minute;
				$hour['absoluteminute'] = $_hour * 60 + $minute;

			}	
			return $hour;
		}

		private function getDateFromString($str)
		{
			$months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
							'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		    
			$pattern = "/(\d*)-(\d*)-(\d*)/";
			$date = array();
		    
			if ( preg_match( $pattern, $str, $matches ) )
			{
		        list( $year, $month, $day) = array( $matches[1], $matches[2], $matches[3]);
				$date['mday']   = $day;
				$date['mon']    = $month;
				$date['year']   = $year;
				$date['month']  = $months[$month-1];
				$date['timestamp'] = mktime(0,0,0, $month, $day, $year);
				$date['dayofweek'] = date('N', $date['timestamp']) - 1;	
				$date['week'] = date('W', $date['timestamp']);
				$date['beautifuldate'] = $day."/".substr($months[$month-1],0,3)."/".$year;
			}
			
			return $date;
		}
	}
?>
