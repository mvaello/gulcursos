class LectureRejected < ActiveRecord::Migration
  def self.up
    add_column :lectures, :rejected, :integer, :default => 0
  end

  def self.down
    remove_column :lectures, :rejected
  end
end
