class StuckLecture < ActiveRecord::Migration
  def self.up
    add_column :lectures, :stuck, :integer, :default => 0
  end

  def self.down
    remove_column :lectures, :stuck
  end
end
