class ThinVotes < ActiveRecord::Migration
  def self.up
    remove_column :votes, :mark
    remove_column :votes, :from
    remove_column :votes, :comments
  end

  def self.down
    add_column :votes, :mark
    add_column :votes, :from
    add_column :votes, :comments
  end
end
