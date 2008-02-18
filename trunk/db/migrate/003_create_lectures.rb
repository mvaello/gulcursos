class CreateLectures < ActiveRecord::Migration
  def self.up
    create_table :lectures do |t|
      t.string  :title
      t.string  :teacher
      t.string  :room
      t.string  :briefdescription
      t.text    :description
      t.text    :suggestedskills
      t.integer :level
      t.integer :course_id
      t.text    :referencesurl
      t.date    :date
      t.time    :startingtime
      t.time    :endingtime
      t.text    :assistedby
      t.date    :publishedon
    end
  end

  def self.down
    drop_table :lectures
  end
end
