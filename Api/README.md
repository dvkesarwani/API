
## Basic Requirements
- PHP 7.x
- Composer

## Installation
- Go to the project directory
- Run the command ```composer install```

## Running the App in Command Line
- Go to the project directory
- Run ```php artisan quote:shout```
- Enter the requested inputs

## Running the App Through a HTTP Server
- Go to the project directory
- Run ```php -S localhost:8000 -t public```
- On the browser, visit http://localhost:8000/api/v1/shout/{author-name}?limit={limit-amount}
- Feel free to replace the author name into any author name, and the limit-amount into any amount as there are server side validations
- You can also CURL it from the command line.

## Unit Testing
- Go to the project directory
- Run ```vendor/bin/phpunit```

# iPresence Tech Test 



We want you to implement a REST API that, given a famous person and a count N, returns N quotes from this famous person _shouted_ .

Shouting a quote consists of transforming it to uppercase and adding an exclamation mark at the end. 

Our application could have multiple sources to get the quotes from, for example an REST API like https://theysaidso.com/api/ could be used, 
although for the sake of the test we provided a sample of quotes by famous persons that can be used, so no need to perform real calls to our source API

We also want to get a cache layer of these quotes in order to avoid hitting our source (which let's imagine is very expensive) twice for the same person given a T time.

## Example 

Given these quotes from Steve Jobs:
- "The only way to do great work is to love what you do.",
- "Your time is limited, so don’t waste it living someone else’s life!"

The returned response should be:
```
curl -s http://awesomequotesapi.com/shout/steve-jobs?limit=2
[
    "THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!",
    "YOUR TIME IS LIMITED, SO DON’T WASTE IT LIVING SOMEONE ELSE’S LIFE!"
]
```

## Constraints 
- Count N provided MUST be equal or less than 10. If not, our API should return an error.
- Any framework is allowed but Laravel

## What will we evaluate?
* **Design**: We know this is a very simple application but we want to see how you design code. We value having a clear application architecture, that helps maintain it (and make changes requested by the product owner) for years.
* **Testing**: We love automated testing and we love reliable tests. We like testing for two reasons: First, good tests let us deploy to production without fear (even on a Friday!). Second, tests give a fast feedback cycle so developers in dev phase know if their changes are breaking anything.
* **Simplicity**: If our product owner asks us for the same application but accessed by command line (instead of the http server) it should be super easy to bring to life!
