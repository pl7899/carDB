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
	echo "-d --card : delete a car"
	echo "-u --caru : update a car"
	echo "-m --maint : create a maintenance item"
	echo "-r --maintr : remove a maintenance item"
	echo "-e --mainte : edit a maintenance item"
	echo "-s --showmaint : show all maintenance items in the database"
	echo "-v --showcars : show all cars in the database"
	echo "-99 --TEST : test basic connectivity to the server"
	echo "-h --help : show commands supported by this script"
fi

# run basic connection test 
if [ "$1" = "--TEST" ] || [ "$1" = "-99" ]
then
   echo "running basic connectivity test"
   curl -s --data "action=outputTest" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -cols "$cols" -T text/html
fi

# add a car  --car -c
if [ "$1" = "--car" ] || [ "$1" = "-c" ]
then
    printf "Submitting info to DB: ${NC}" 
	curl -s --data "action=submit_new_vehicle&vin=$2&make=$3&model=$4&plate=$5&registration=$6&miles=$7&image=$8" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# delete a car --card -d
if [ "$1" = "--card" ] || [ "$1" = "-d" ]
then
    printf "Deleting a Car: ${NC}" 
	curl -s --data "action=delete_vehicle&vin=$2" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
fi

# update a car --caru -u
if [ "$1" = "--maint" ] || [ "$1" = "-m" ]
then
    printf "Updating a Car: ${NC}" 
    echo $2
	curl -s --data "action=addTask&task=$2&project=$3&priority=$4" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
    curl -s --data "action=retrieveTaskListForProject&project=$3&previousProject=default" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -cols "$cols" -T text/html

fi

# add a maintenance item --maint -m
if [ "$1" = "--maint" ] || [ "$1" = "-m" ]
then
    printf "Adding Maintenance Item: ${NC}" 
    echo $2
	curl -s --data "action=addTask&task=$2&project=$3&priority=$4" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
    curl -s --data "action=retrieveTaskListForProject&project=$3&previousProject=default" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -cols "$cols" -T text/html

fi

# remove a mantenaince item --maintr -r 
if [ "$1" = "--maint" ] || [ "$1" = "-m" ]
then
    printf "Removing a Maintenance Item: ${NC}" 
    echo $2
	curl -s --data "action=addTask&task=$2&project=$3&priority=$4" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -T text/html
    curl -s --data "action=retrieveTaskListForProject&project=$3&previousProject=default" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -cols "$cols" -T text/html

fi

# edit a mantenanince item  --mainte -e
if [ "$1" = "--late" ] || [ "$1" = "-l" ] || [ "$1" = "late" ]
then
    printf "showing ${RED}Late${NC} tasks: "
    curl -s --data "action=retrieveLateTasks" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -cols "$cols" -T text/html
fi

# show all maint items    --showmaint -s
if [ "$1" = "--setProject" ] || [ "$1" = "-s" ]
then
    printf "showing tasks from : ${RED} %s ${NC}"  $2
    curl -s --data "action=retrieveTaskListForProject&project=$2&previousProject=default" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -cols "$cols" -T text/html
fi

# show all cars           --showcars -v
if [ "$1" = "--Close" ] || [ "$1" = "-c" ] || [ "$1" = "close" ]
then
	printf "Closing task ${GREEN} %s ${NC}" $2
    curl -s --data "action=closeTaskByNumber&taskID=$2" https://northridge-studios.com/cardb/cardb_interface.php | w3m -dump -cols "$cols" -T text/html
fi

echo "carDB script exiting"