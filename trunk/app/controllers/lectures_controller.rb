class LecturesController < ApplicationController

  def contents
      @lecture = Lecture.find(params[:id])
      @root = amIRoot?
  end

  def vote
    begin
      lecture_id = params[:id]
      ip = request.env['REMOTE_ADDR']
      lecture = Lecture.find(lecture_id)
      hasVoted = lecture.hasVoteFrom(ip)
      if !hasVoted && lecture.course.phase == Course::PHASE_VOTES
        vote = Vote.new
        vote.lecture_id = lecture_id
        vote.ip = ip
        vote.datetime = Time.now.strftime("%Y-%m-%d %H:%M:%S")
        vote.save
      end
      render :text => "#{lecture.vote.count} votos <div class='senkiu'> ¡Gracias! </div>"
    rescue Exception => e
      redirect_to "/courses"
    end
  end

  def new
    begin      
      course_id = params[:id]
      course = Course.find(course_id)
      if course != nil && amIRoot?
        @lecture = Lecture.new
        @lecture.course_id = course_id
        render :action => "new", :layout => "courses"
      else
        redirect_to("/courses/#{course_id}")
      end
    rescue Exception => e
      redirect_to "/courses"            
    end
  end

  def proposeme
    begin
      course_id = params[:id]
      course = Course.find(course_id)
      if course != nil && course.phase == Course::PHASE_PROPOSALS
        @lecture = Lecture.new
        @lecture.course_id = course_id
      else
        redirect_to("/courses/#{course_id}")
      end      
    rescue Exception => e
      redirect_to "/courses"
    end    
  end

  def proposeother
    begin      
      course_id = params[:id]
      course = Course.find(course_id)
      if course != nil && course.phase == Course::PHASE_PROPOSALS
        @lecture = Lecture.new
        @lecture.course_id = course_id
      else
        redirect_to("/courses/#{course_id}")
      end
    rescue Exception => e
      redirect_to "/courses"
    end
  end

  def edit
    begin
      @lecture = Lecture.find(params[:id])
      if amIRoot? && @lecture != nil
        render :action => "edit", :layout => "courses"
      else
        redirect_to(@lecture)
      end      
    rescue Exception => e
      redirect_to "/courses"
    end
  end

  def createfromproposeme
    begin      
      @lecture = Lecture.new(params[:lecture])
      @lecture.skipTeacherValidation = false;
      if @lecture.save
        flash[:notice] = '¡Gracias por proponer tu charla y suerte en las votaciones!'
        redirect_to("/courses/#{@lecture.course_id}")
      else
        render :action => "proposeme"
      end
    rescue Exception => e
      redirect_to "/courses"
    end
  end

  def createfromproposeother
    begin
      @lecture = Lecture.new(params[:lecture])
      @lecture.skipTeacherValidation = true;
      if @lecture.save
        flash[:notice] = '¡Gracias por la propuesta y esperemos que alguien la lleve a cabo!'
        redirect_to("/courses/#{@lecture.course_id}")
      else
        render :action => "proposeother"
      end
    rescue Exception => e
      redirect_to "/courses"
    end    
  end

  def create
    begin
      @lecture = Lecture.new(params[:lecture])
      @lecture.skipTeacherValidation = true;
      if amIRoot? && @lecture.save
        flash[:notice] = '¡El curso se ha creado!'
        redirect_to("/courses/#{@lecture.course_id}")
      else
        render :action => "new"
      end
    rescue Exception => e
      redirect_to "/courses"
    end
  end

  def update
    begin
      @lecture = Lecture.find(params[:id])
      @root = amIRoot?
      if @lecture != nil && @lecture.update_attributes(params[:lecture])
        flash[:notice] = '¡Charla editada!'
        redirect_to session[:referer]
      else
        render :action => "edit"
      end
    rescue Exception => e
      redirect_to "/courses"
    end
  end

  def destroy
    begin
      @lecture = Lecture.find(params[:id])
      if amIRoot? && @lecture != nil
        @lecture.destroy
        flash[:notice] = '¡Charla borrada!'
      end
      redirect_to "/courses/#{@lecture.course_id}"
    rescue Exception => e
      redirect_to "/courses"
    end
  end
  
  def pupilform
    @lecture = Lecture.find(params[:id])
  end
  
  def thanks
  end
  
  def addpupil
    begin
      @pupil = Pupil.new(params[:pupil])
      @pupil.certificate = 1;
      @lecture = Lecture.find(@pupil.lecture_id);
      if @pupil.save
        render :action => "thanks"
      else
        flash[:error] = "Es necesario que digas tu nombre y tu email para poder expedirte un certificado."
        render :action => "pupilform"
      end
    rescue Exception => e  
      redirect_to "/courses"    
    end    
  end
  
  def rss
    @lectures = Lecture.find :all, :order => "id DESC", :limit => 10
    @news = News.find :all, :order => "id DESC", :limit => 10    
    headers["Content-Type"] = "application/xml; charset=utf-8"
  end
  
end
