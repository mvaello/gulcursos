class UsersController < ApplicationController
  def dologin
    if params[:password] == "lalala"
      session[:loginValidated] = true
      session[:username] = params[:username]
      redirect_to session[:referer]
    else
      logout
    end        
  end
  
  def logout
    session[:loginValidated] = false;
    redirect_to session[:referer]
  end
  
  def style
    session[:style] = params[:id]
    redirect_to session[:referer]
  end
end
