require File.dirname(__FILE__) + '/../test_helper'

class LecturesControllerTest < ActionController::TestCase
  def test_should_get_index
    get :index
    assert_response :success
    assert_not_nil assigns(:lectures)
  end

  def test_should_get_new
    get :new
    assert_response :success
  end

  def test_should_create_lecture
    assert_difference('Lecture.count') do
      post :create, :lecture => { }
    end

    assert_redirected_to lecture_path(assigns(:lecture))
  end

  def test_should_show_lecture
    get :show, :id => lectures(:one).id
    assert_response :success
  end

  def test_should_get_edit
    get :edit, :id => lectures(:one).id
    assert_response :success
  end

  def test_should_update_lecture
    put :update, :id => lectures(:one).id, :lecture => { }
    assert_redirected_to lecture_path(assigns(:lecture))
  end

  def test_should_destroy_lecture
    assert_difference('Lecture.count', -1) do
      delete :destroy, :id => lectures(:one).id
    end

    assert_redirected_to lectures_path
  end
end
