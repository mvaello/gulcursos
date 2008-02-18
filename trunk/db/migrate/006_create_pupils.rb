class CreatePupils < ActiveRecord::Migration
  def self.up
    create_table :pupils do |t|
      t.string    :name
      t.string    :email
      t.integer   :lecture_id
      t.datetime  :datetime
      t.integer   :certificate
    end
  end

  def self.down
    drop_table :pupils
  end
end
