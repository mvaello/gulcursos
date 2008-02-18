class CoursePhases < ActiveRecord::Migration
  def self.up
    remove_column :courses, :closed
    remove_column :courses, :proposals
    remove_column :courses, :votes
    add_column :courses, :phase, :integer, :default => 0
  end

  def self.down
    remove_column :courses, :phase
    add_column :courses, :closed, :integer, :default => 0
    add_column :courses, :proposals, :integer, :default => 0
    add_column :courses, :votes, :integer, :default => 0    
  end
end
