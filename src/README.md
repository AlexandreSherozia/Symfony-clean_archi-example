* In the real DDD approach, Domain shouldn't have entities like Garage, but rather GarageCreatePlan or something like that,
* showing an intention of action. This class will have a lifecycle.
*
* In this case, it's just a mirror of doctrine entity, which is not correct.
*
* TO DO refactoring in cqrs branch : 
* 
  * Follow CQRS & Event sourcing rules :
  
    * Identify "Writing" and "Reading" Use cases. Separate them by Command and Query
    * Create "Command" classes accordingly to my useCases. 
       EX: CreateGarageSubscriptionCommand DTO implementing CommandInterface
    * Create command handlers and event dispatchers ...
    * BUSes, Middlewares
  
