# Summary
Intercity ticket sales service based on [Lucid architecture](https://lucid-architecture.gitbook.io/docs/). 

# Components
- Composbles
- Domains
- Data
- Service

## Composables
reusable components like Traits  to build applications more quickly and easily.
on this component I created Responses Composable that responsible for manage json responses like present data, throw failure response etc.

## Domains
implement the business logic and expose them through jobs, no domain calls another. Jobs do the actual work. Being the smallest unit in the Lucid architecture, a Job should do one thing, and one thing only. That is: perform a single task.

## Data
Owns the data (duh!), which means models, repositories, DTO, repositories... you name it. Yet domains remain to be isolate, self-satisfied and no cross-domain relationships exist while data is organically related; if we included them in domains we would’ve ended up working with cross-domain dependencies which defies the idea of domains being self-contained.

## Services
They implement the features but do not implement the logic of the feature themselves, their responsibility is to compose Jobs from Domains. Think of a Job as a step if the feature was a user story; and an Operation is a group of steps that are often executed together to accomplish a single purpose.
__feature__:  It runs Jobs to perform its tasks. They are thought of as the steps in the process of serving its purpose. A Feature can be served from anywhere, most commonly Controllers and Commands.

## Notables
 - __Exception Handling__: If you look at the app/Exceptions directory, you will see the way I handled general exceptions, such as a  "not found" & "unauthenticated" errors.
  - __TODO__: Considering that this project was force, I wrote necessary TODOs.
  - __DTO__: I used my custom data transfer object, which is an abstract class available in the Composables Component.
