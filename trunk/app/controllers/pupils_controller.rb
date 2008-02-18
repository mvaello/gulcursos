class PupilsController < ApplicationController
  # GET /pupils
  # GET /pupils.xml
  def index
    @pupils = Pupil.find(:all)

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @pupils }
    end
  end

  # GET /pupils/1
  # GET /pupils/1.xml
  def show
    @pupil = Pupil.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @pupil }
    end
  end

  # GET /pupils/new
  # GET /pupils/new.xml
  def new
    @pupil = Pupil.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @pupil }
    end
  end

  # GET /pupils/1/edit
  def edit
    @pupil = Pupil.find(params[:id])
  end

  # POST /pupils
  # POST /pupils.xml
  def create
    @pupil = Pupil.new(params[:pupil])

    respond_to do |format|
      if @pupil.save
        flash[:notice] = 'Pupil was successfully created.'
        format.html { redirect_to(@pupil) }
        format.xml  { render :xml => @pupil, :status => :created, :location => @pupil }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @pupil.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /pupils/1
  # PUT /pupils/1.xml
  def update
    @pupil = Pupil.find(params[:id])

    respond_to do |format|
      if @pupil.update_attributes(params[:pupil])
        flash[:notice] = 'Pupil was successfully updated.'
        format.html { redirect_to(@pupil) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @pupil.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /pupils/1
  # DELETE /pupils/1.xml
  def destroy
    @pupil = Pupil.find(params[:id])
    @pupil.destroy

    respond_to do |format|
      format.html { redirect_to(pupils_url) }
      format.xml  { head :ok }
    end
  end
end
