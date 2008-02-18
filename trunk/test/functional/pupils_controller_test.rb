require File.dirname(__FILE__) + '/../test_helper'

class PupilsControllerTest < ActionController::TestCase
  def test_should_get_index
    get :index
    assert_response :success
    assert_not_nil assigns(:pupils)
  end

  def test_should_get_new
    get :new
    assert_response :success
  end

  def test_should_create_pupil
    assert_difference('Pupil.count') do
      post :create, :pupil => { }
    end

    assert_redirected_to pupil_path(assigns(:pupil))
  end

  def test_should_show_pupil
    get :show, :id => pupils(:one).id
    assert_response :success
  end

  def test_should_get_edit
    get :edit, :id => pupils(:one).id
    assert_response :success
  end

  def test_should_update_pupil
    put :update, :id => pupils(:one).id, :pupil => { }
    assert_redirected_to pupil_path(assigns(:pupil))
  end

  def test_should_destroy_pupil
    assert_difference('Pupil.count', -1) do
      delete :destroy, :id => pupils(:one).id
    end

    assert_redirected_to pupils_path
  end
end
