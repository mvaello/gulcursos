class Lecture < ActiveRecord::Base

  ACCEPTANCE_ACCEPTED = 1
  ACCEPTANCE_REJECTED = 2
  
  belongs_to :course
  has_many :vote, :dependent => :destroy
  has_many :pupil, :dependent => :destroy
  
  validates_presence_of :briefdescription, :on => :create, :message => "Necesito una pequeña descripción"
  validates_presence_of :title, :on => :create, :message => "Necesito un título"
  validates_presence_of :teacher, :on => :create, :message => "Necesito un ponente", :unless => :shouldSkipTeacherValidation

  validates_presence_of :briefdescription, :on => :update, :message => "Necesito una pequeña descripción", 
                        :unless => :shouldSkipBriefDescriptionValidation
                        
  validates_presence_of :title, :on => :update, :message => "Necesito un título"
    
  attr_accessor :skipTeacherValidation
  attr_accessor :skipBriefDescriptionValidation
    
  def hasVoteFrom(ip)
    hasIt = false;
    vote.each do |vote| 
      if (vote.ip == ip)
        hasIt = true
      end
    end
    return hasIt
  end
  
  def shouldSkipTeacherValidation
    return @skipTeacherValidation
  end
  
  def shouldSkipBriefDescriptionValidation
    return @skipBriefDescriptionValidation
  end
    
end
