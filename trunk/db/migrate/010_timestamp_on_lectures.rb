class TimestampOnLectures < ActiveRecord::Migration
  def self.up
    add_column :lectures, :created_at, :datetime
    add_column :lectures, :updated_at, :datetime    
  end

  def self.down
    remove_column :lectures, :created_at
    remove_column :lectures, :updated_at
  end
end
