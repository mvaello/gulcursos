module CoursesHelper

  class Week
    def initialize
      @days = Array.new
      @i = 0
    end

    def add (day)
      @days[@i] = day
      @i = @i + 1;
    end

    def days
      return @days
    end

  end

  class Day
    def initialize
      @lectures = Array.new
      @i = 0
    end

    def add (lecture)
      @lectures[@i] = lecture
      @i = @i + 1;
    end

    def lectures
      lec = @lectures.sort_by { |lecture| lecture.startingtime }
      return lec
    end

  end

  class Calendar
    def fill(course)
#      begin
        lectures = Array.new
        i = 0
        
        course.lecture.each do |lecture|
          if lecture.date
            lectures[i] = lecture
            i = i + 1
          else
            skip lecture
          end
        end
        if i == 0
          return true
        end

        lectures = lectures.sort_by { |lecture| lecture.date }

        firstWeek = lectures[0].date.cweek
        lastWeek = -1
        lastDay  = 0;

        currentWeek = nil;
        currentDay  = nil;

        lectures.each do |lecture|

          date = lecture.date
          week = date.cweek - firstWeek
          day  = date.cwday

          while week > lastWeek
            lastWeek = lastWeek + 1
            currentWeek = Week.new
            add currentWeek
            lastDay = 0;
          end

          while day > lastDay
            lastDay = lastDay + 1
            currentDay = Day.new
            currentWeek.add currentDay
          end

          currentDay.add lecture         
        end
      # rescue Exception => e
      #    return false
      #  end
      
      return true
    end

    def initialize
      @weeks = Array.new
      @skipped = Array.new
      @i = 0
      @j = 0
    end

    def add (week)
      @weeks[@i] = week
      @i = @i + 1;
    end

    def weeks
      return @weeks
    end

    def skip (lecture)
      @skipped[@j] = lecture
      @j = @j + 1
    end
    
    def skipped
      return @skipped
    end
  end

end
