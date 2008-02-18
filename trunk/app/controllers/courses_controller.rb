class CoursesController < ApplicationController

  def index
    @courses = Course.find(:all).reverse
    @root = amIRoot?
    session[:referer] = "/courses/"
  end

  def show
    begin
      @course = Course.find(params[:id])
      @root = amIRoot?
      @ip = request.env['REMOTE_ADDR']
      session[:referer] = "/courses/#{params[:id]}"      
    rescue Exception => e
      redirect_to "/courses"
    end
  end

  def new
    if amIRoot?
      session[:referer] = "/courses/new"
      @course = Course.new
      news = News.new
      news.title = "#{@course.title}: comenzamos"
      news.body = "Comienza la organización de estas jornadas."
      news.save!
    else
      redirect_to("/courses")
    end
  end

  def edit
    begin
      session[:referer] = "/courses/edit/#{params[:id]}"
      @course = Course.find(params[:id])
      if amIRoot? && @course != nil
      else
        redirect_to("/courses")
      end      
    rescue Exception => e
      redirect_to "/courses"
    end    
  end

  def create
    @course = Course.new(params[:course])
    if @course.save
      redirect_to(courses_url)
    else
      render :action => "new"
    end
  end

  def update
    begin
      @course = Course.find(params[:id])
      lastPhase = @course.phase      
      if amIRoot? && @course.update_attributes(params[:course])
        
        if @course.phase != lastPhase
          news = News.new
          news.title = "#{@course.title}: pasamos a #{@course.phaseName}"
          news.body = @course.descriptionForPhase
          news.save!
        end
        
        redirect_to(courses_url)
      else
        render :action => "edit"
      end      
    rescue Exception => e
      redirect_to "/courses"      
    end
  end

  def destroy
    begin
      @course = Course.find(params[:id])
      if amIRoot? && @course != nil
        @course.destroy
      end
      redirect_to(courses_url)      
    rescue Exception => e
      redirect_to "/courses"
    end
  end

  def calendar
    course_id = params[:id]
    @course = Course.find(course_id)
    @calendar = CoursesHelper::Calendar.new
    @success = @calendar.fill @course
    session[:referer] = "/courses/calendar/#{course_id}"
  end

  def winners
    if amIRoot?
      course_id = params[:id]    
      @course = Course.find(course_id)
      @stuckLectures = @course.lecture.find_all { |lecture| lecture.stuck > 0}
      @winningLectures = @course.lecture.find_all { |lecture| lecture.stuck == 0}
      @winningLectures = @winningLectures.sort_by { |lecture| lecture.vote.count*1000+lecture.pupil.count }.reverse  
      session[:referer] = "/courses/winners/#{course_id}"
    else
      redirect_to("/courses")
    end
  end

  def batch
    if amIRoot?
      roomName = params[:batch_room]
      params.each do |name, value| 
        if name =~ /check_(\w+)_(\d+)/
          lecture = Lecture.find $2
          lecture.skipBriefDescriptionValidation = true
          lecture.rejected = 0 if $1 == "accept" 
          lecture.rejected = 1 if $1 == "reject" 
          lecture.room = roomName if $1 == "room" 
          lecture.save!
        end
      end
      redirect_to session[:referer]
    else
      redirect_to("/courses")
    end
  end
end
