#!/bin/sh

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
AQUA='\033[0;36m'
MAGENTA='\033[0;35m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color
printf "${RED}carDB ... ${NC} Track that work!\n"

cols=`tput cols`
# add a car  --car -c
# delete a car --card -d
# update a car --caru -u
# add a maintenance item --maint -m
# remove a mantenaince item --maintr -r 
# edit a mantenanince item  --mainte -e
# show all maint items    --showmaint -s
# show all cars           --showcars -v
# run basic connection test 
# show help for script

# show help for script
if [ "$1" = "--help" ] || [ "$1" = "-h" ] || [ "$1" = "-H" ]
then
	echo "-c --car : add a car [vin make model plate registration miles image]"
	echo "-d --card : delete a car [id]"
	echo "-u --caru : update a car"
	echo "-m --maint : create a maintenance item [/"description/" cost garage miles]"
	echo "-r --maintr : remove a maintenance item [id]"
	echo "-e --mainte : edit a maintenance item"
	echo "-s --showmaint : show all maintenance items in the database"
	echo "-v --showcars : show all cars in the database"
	echo "-99 --TEST : test basic connectivity to the server"
	echo "-h --help : show commands supported by this script"
fi

# run basic connection test 
if [ "$1" = "--TEST" ] || [ "$1" = "-99" ]
then
   printf "${GREEN}running basic connectivity test ${NC}" 
   curl -s --data "action=outputTest" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -cols "$cols" -T text/html
fi

# add a car  --car -c
if [ "$1" = "--car" ] || [ "$1" = "-c" ]
then
    printf "${GREEN}Submitting car info to DB:${NC}" 
	curl -s --data "action=submit_new_vehicle&vin=$2&make=$3&model=$4&plate=$5&registration=$6&miles=$7&image=$8" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# delete a car --card -d
if [ "$1" = "--card" ] || [ "$1" = "-d" ]
then
    printf "${GREEN}Deleting a Car:${NC}" 
	curl -s --data "action=delete_vehicle&id=$2" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# update a car --caru -u
if [ "$1" = "--caru" ] || [ "$1" = "-u" ]
then
    printf "${GREEN}Updating a Car:${NC}" 
	curl -s --data "action=update_existing_vehicle&vehicletoupdate=$2&updatestring=$3" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# add a maintenance item --maint -m
if [ "$1" = "--maint" ] || [ "$1" = "-m" ]
then
    printf "${GREEN}Adding Maintenance Item:${NC}" 
	curl -s --data "action=submit_new_maint&vin=$2&make=$3&model=$4&plate=$5&registration=$6&miles=$7&image=$8" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# remove a mantenaince item --maintr -r 
if [ "$1" = "--maintr" ] || [ "$1" = "-r" ]
then
    printf "${GREEN}Removing a Maintenance Item:${NC}" 
	curl -s --data "action=delete_maint&task=$2&project=$3&priority=$4" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# edit a mantenanince item  --mainte -e
if [ "$1" = "--mainte" ] || [ "$1" = "-e" ]
then
    printf "${GREEN}Editing a Maintenance Item:${NC}" 
	curl -s --data "action=update_existing_maint&idmaintenancetoupdate=$2&updatestring=$3" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# show all maint items    --showmaint -s
if [ "$1" = "--showmaint" ] || [ "$1" = "-s" ]
then
    printf "${GREEN}Show all Maintenance Item:${NC}" 
	curl -s --data "action=dump_maint" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# show all cars           --showcars -v
if [ "$1" = "--showcars" ] || [ "$1" = "-v" ]
then
    printf "${GREEN}Show all cars:${NC}" 
	curl -s --data "action=dump_vehicles" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

echo "carDB script exiting"