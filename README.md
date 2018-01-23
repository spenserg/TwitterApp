# Twitter App

## Overview
I chose to build the TwitterApp because I felt it provided the best opportunity to showcase my skills in the provided languages. Additionally, I have never worked with the Twitter API before and it gave me a chance to become familiar with it.

## Usage
To use the application, enter a handle or search term and a number of tweets. Users may use either a handle, a search term, or both, though the number of tweets is required. The location is optional, and accepts string locations. Coordinates are not yet supported, and if entered, the application will display a warning. If the user tries to submit the form without a search term or handle, an error will display and the missing fields will be highlighted. To submit the form, click the "Search" button at the bottom of the form.

If the information is valid, the results of your search will be displayed. URLs, hashtags, and screen names become clickable links that take the user to the respective twitter page. Each box can be hidden from the page by clicking a small "X" at the top corner of the box. Boxes hidden this way will disappear until another search is done.

If there are no results, the application will show a notification that no results were found as well as the respective search terms used. The user may return to the search page by clicking the "Return to Search Page" button. Clicking the "Return to Search Page" takes the user back to the previous page, automatically filling in the boxes with the previous search queries.

## Notes

I decided to use CakePHP and Bootstrap to build this application because they both allowed me to create a relatively good looking prototype in a short amount of time. Additionally, CakePHP has built in functions for logging users in and out that I could use to implement the bonus feature of logging a user in and posting a tweet.

All external libraries use the MIT License. I decided to use the Twitter Plugin written by mishudark because it only had two known issues and was relatively simple compared to other programs that built specifically to work with CakePHP.

By default, search will pull the most recent tweets. Twitter has the option to pull by popularity, I decided to make the results appear in chronological order because the basic API is limited to searching only the past seven days. Additionally, I've limited the number of results to 100 because it is the same limitation the Twitter API uses.

Twitter's API has an option of retrieving full text instead of the stunted version, but even when used, some instances of a tweet's "full text" will be appear chopped off.

## Requirements

The application supports the latest, stable releases of all major browsers and platforms.

## External Libraries Used

JQuery v3.3.1<br/>
Purpose: Javascript library to simplify HTML manipulation
Released under the MIT license, copyright 2018
http://jquery.com/

CakePHP v3.5
Purpose: Pre-built MVC framework
Released under the MIT license, copyright 2018
Requirements: PHP version 5.6.0+
https://cakephp.org/

Bootstrap v4.0
Purpose: Toolkit used to design user interface
Released under the MIT license, copyright 2018 Twitter
https://getbootstrap.com/

CakePHP-2.x-Twitter-Plugin
Purpose: CakePHP Plugin used to interact with Twitter API
Released under the MIT license
Requirements: PHP version 5.2+, CakePHP version 2.0+
https://github.com/mishudark/CakePHP-2.x-Twitter-Plugin

## License

The MIT License (MIT)

Copyright (c) 2018 Spenser Galloway

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.