class CreateVotes < ActiveRecord::Migration
  def self.up
    create_table :votes do |t|
      t.integer   :lecture_id
      t.datetime  :datetime
      t.integer   :mark
      t.string    :from
      t.text      :comments
      t.text      :ip
    end
  end

  def self.down
    drop_table :votes
  end
end
