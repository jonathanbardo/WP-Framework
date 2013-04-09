from fabric.api import *
from fabric.context_managers import settings
from fabric.contrib.console import confirm
from fabric.colors import green, red
import datetime

project_name = 'project'
folder_name = 'project'

@task
def translate(project=''):
    if(project == ''):
        project = prompt("Please enter project theme name you want to compile translation : ")

    if(project == 'project'):
    	project = 'mu-plugins/jb-project'
    else:
    	project = 'themes/' + project;

    local('msgfmt ../wp-content/%s/languages/en_US.po -o ../wp-content/%s/languages/en_US.mo' % (project,project))
    local('msgfmt ../wp-content/%s/languages/fr_FR.po -o ../wp-content/%s/languages/fr_FR.mo' % (project,project))
    print(green('Done compiling French & English binaries !'))