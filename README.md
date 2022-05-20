# Word quiz

## About the app
A simple “word game” web application - Symfony framework.  

## What does it to:  
The user is able to enter a word in the application via URI (e.g. http://127.0.0.1:8000/{concrete_word}).  
The app allows only the words that are in the English dictionary. This is checked by dictionary web API.  
(The API is not really great since it does not recognize some existing english words (e.g. "hell"). Since it's only for demo purpose - the API quality is not important.)  
Application scores the word by the following rules:  
a) Gives 1 point for each unique letter.  
b) Gives 3 extra points if the word is a palindrome.  
c) Gives 2 extra points if the word is “almost palindrome”. (“almost palindrome” = if by removing at most one letter from the word, the word will be a true palindrome.)  
