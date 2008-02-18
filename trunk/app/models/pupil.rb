class Pupil < ActiveRecord::Base
  validates_presence_of :name, :on => :create, :message => "Necesito tu nombre"
  validates_presence_of :email, :on => :create, :message => "Necesito un email"
end
