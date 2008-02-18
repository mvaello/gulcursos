class Course < ActiveRecord::Base
  has_many :lecture, :dependent => :destroy

  PHASE_PROPOSALS = 0
  PHASE_VOTES     = 1
  PHASE_CALENDAR  = 2
  PHASE_CLOSED    = 3

  @@phaseNames = [
    'Propuestas', 
    'Votaciones',
    'Organizando',
    'Cerradas'
  ]

  @@phaseDescriptions = [
    'Si te interesa un tema o quieres dar un curso, ¡proponlo!', 
    '¿Te interesa alguna de estas charlas? ¡Vota para que salga elegida!',
    'Estamos organizando el calendario de charlas, ¡no te pierdas ni una!',
    'Estas charlas ya se han dado, ¡gracias!'
  ]

  def phaseName
    return @@phaseNames[phase]
  end


  def descriptionForPhase
    return @@phaseDescriptions[phase]
  end

end
