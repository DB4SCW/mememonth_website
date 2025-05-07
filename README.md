# Website for Meme Appreciation Month
This is the website for Meme Appreciation Month, a website for a amateur radio special event centered around meme culture.

## Frontend
This page is almost 100% HTML and PHP. The only client side Javascript is used for tab switching.

## Backend
This website uses a sqlite database as its data source. If the database file does not exist, the first page load will create it. It is then your responsibility to fill the database with events and callsigns.

The following things are loaded dynamically from the database:
- Page title
- Structure of tabs (for example archive tabs)
- Description of each event on the main page
- The current event title under the descriptions
- Award button link
- Registered callsigns in the "who" tab
- Dates of the event in the "when" tab
- All archive tabs, including event title, list of callsigns and award program button (or lack thereof)

This means once you like to change over to the next years event, just insert a new row to the mememonths table of the database. Then, the "who" tab will roll over to a new archive tab and present completely empty. 

You can then add the callsigns for this new event and the page will fill up again.

## API
This website provides an API for other websites to use it as an authoritative data source for registered special event callsigns. 
You can reach it at: ```https://your.site.here/api.php```

If you just call it like this, it will give you all callsigns ever as a JSON file. 
You can add the following parameters, either as get parameters or as post parameters: 
- year
- region

If you do provide both GET and POST values for the same parameter, POST values will override GET. But please stop doing that ;)

For example, this will give you all callsigns in 2024 registered in IARU region 1 as JSON:
```https://your.site.here/api.php?year=2024&region=1```
