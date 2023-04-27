import requests
from bs4 import BeautifulSoup
import re
import urllib
from time import sleep
import json
import pandas as pd
import os
from itertools import chain
from urllib.request import urlopen
import ssl
ssl._create_default_https_context = ssl._create_unverified_context

# This method finds the urls for each of the rosters in the NBA using regexes.
def build_team_urls():
    # Open the espn teams webpage and extract the names of each roster available.
    f = urllib.request.urlopen('https://www.espn.com/nba/teams')
    teams_source = f.read().decode('utf-8')
    teams = dict(re.findall("www\.espn\.com/nba/team/_/name/(\w+)/(.+?)\",", teams_source))
    # Using the names of the rosters, create the urls of each roster
    roster_urls = []
    for key in teams.keys():
        # each roster webpage follows this general pattern.
        roster_urls.append('https://www.espn.com/nba/team/roster/_/name/' + key + '/' + teams[key])
        teams[key] = str(teams[key])
    return dict(zip(teams.values(), roster_urls))

team_page_url = "https://www.espn.com/nba/team/roster/_/name/bos/boston-celtics"

def get_player_info(roster_url, file_path):
    f = urllib.request.urlopen(roster_url)
    print(roster_url)

    # send a GET request to the team page
    response = requests.get(roster_url)

    # parse the HTML content of the page using BeautifulSoup
    soup = BeautifulSoup(response.content, "html.parser")

    # find the table that contains the player information
    player_table = soup.find("table", {"class": "Table"})

    sleep(0.5) # or sleep(1) for a longer delay
    # loop over each row in the table
    for row in player_table.find_all("tr")[1:]:
        # extract the player name and link to their individual page
        player_name_link = row.find("a", {"class": "AnchorLink"})
        player_page_link = player_name_link["href"]
        player_name = player_page_link.split("/")[8]
        full_name = player_name.split("-")
        # print(full_name[0], full_name[1])

        player_id = player_page_link.split("/")[7]
        # print(player_id)
        image_url = f"https://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/{player_id}.png&w=350&h=254"
        
        with open(file_path, 'a') as f:
            f.write(full_name[0] + " " + full_name[1] + "," + image_url + "\n")


rosters = build_team_urls()
headshot_file = "nba_headshots.csv"
with open(headshot_file, 'w') as f:
    for team in rosters.keys():
        print("Gathering player info for team: " + team)
        get_player_info(rosters[team], headshot_file)
