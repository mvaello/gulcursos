# This file is auto-generated from the current state of the database. Instead of editing this file, 
# please use the migrations feature of ActiveRecord to incrementally modify your database, and
# then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your database schema. If you need
# to create the application database on another system, you should be using db:schema:load, not running
# all the migrations from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended to check this file into your version control system.

ActiveRecord::Schema.define(:version => 10) do

  create_table "courses", :force => true do |t|
    t.string  "title",       :limit => 50,                :null => false
    t.text    "description"
    t.integer "phase",                     :default => 0
  end

  create_table "lectures", :force => true do |t|
    t.string   "title",            :limit => 200
    t.string   "teacher",          :limit => 50
    t.string   "room",             :limit => 50
    t.text     "briefdescription"
    t.text     "description"
    t.text     "suggestedskills"
    t.integer  "level"
    t.string   "referencesurl",    :limit => 100
    t.date     "date"
    t.time     "startingtime"
    t.time     "endingtime"
    t.string   "assistedby",       :limit => 30
    t.datetime "publishedon"
    t.integer  "course_id"
    t.integer  "stuck",                           :default => 0
    t.integer  "rejected",                        :default => 0
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "news", :force => true do |t|
    t.string   "title"
    t.text     "body"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "pupils", :force => true do |t|
    t.string   "name",        :limit => 50, :null => false
    t.string   "email",       :limit => 30, :null => false
    t.integer  "lecture_id"
    t.datetime "datetime"
    t.integer  "certificate"
  end

  create_table "votes", :force => true do |t|
    t.integer  "lecture_id"
    t.datetime "datetime"
    t.string   "ip",         :limit => 20
  end

end
