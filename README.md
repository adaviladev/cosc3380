# databaseProject
Please add project constraints and design principles we should follow as needed.

testing the github bot

This program is run using Vagrant with the Laravel/Homestead 5.4 Virtual Box environment.
Set up instructions can be found [here](https://laravel.com/docs/5.4/homestead): 

##Setting up Vagrant/Homestead with our Project
1. Once you have downloaded the necessary software, use a text editor to open up the .homestead file in your home directory (~/).
2. Create the folder "Code" in your user's home directory.
3. Inside of the Code directory, create another directory named "cosc3380"
2. Replace the lines in the "folders:" with the following
    > map: ~/Code/cosc3380 \
     to: /home/vagrant/Code/cosc3380
     
     - This will map the ~/Code/cosc3380 in your local directory to the /home/vagrant/Code/cosc3380 in the virtual machine
3. Replace the lines in the "sites:" section with the following
    > map: database.app\
      to: /home/vagrant/Code/cosc3380
      
    - This will map the domain database.app to pull the files in the /home/vagrant/Code/cosc3380 directory
    
4. Replace the lines in the "databases:" section with the following
    > \- cosc3380

5. Open up notepad.exe and run it as an administrator.
6. File \> Open
    - Go to "C:\Windows\System32\drivers\etc" and open the "hosts" file.
    
7. At the very bottom enter the following:
   "192.168.10.10 database.app"
   - This will instruct your system to direct all HTTP requests to "database.app" to "192.168.10.10" which is the IP address of your local virtual machine while it's up.
   
8. Using Git Bash, navigate to your Homestead directory ("cd ~/Homestead") and run the following command:
    - ssh-keygen -t rsa -C "you@homestead"
    - This will create a .ssh directory with your ssh key inside for SSh-ing into your virtual machine.
    
9. Using Git Bash, navigate to your home directory and run "vagrant up". This will spin up your virtual environment.
    - If vagrant times out at the ssh step, you may need to edit your BIOS settings and enable virtualization
10. You should now be able to go to "database.app" in your web browser to view the site.
    - If you get a message saying "No input file selected" or something like that, make sure the repository is in the correct location based on the "folders:" and "sites:" sections in the Homestead.yaml file.

## Configuring Aliases
1. Using Git Bash, go to your home directory
    - cd ~
2. do 
    <pre>touch .bashrc</pre>
3. In a text editor, open this file (C:\Users\<username>\.bashrc)
4. Add the following lines
    <pre>
    alias ll="ls -alh"
    alias vgserve="cd ~/Homestead; vagrant up;"</pre>
5. Close and relaunch Git Bash. You should now be able to use 
    - "ll" to list all files in the current directory in a formatted manner.
    - "vgserve" to automatically navigate to your Homestead foler and spin up the virtual machine from any directory
## Connecting PHPStorm with Our Database
1. Select View > Tool Windows > Database
2. A window should pop up on the right side. Click the Plus sign.
3. Select Data Source
4. Select MySQL
5. A new window should pop up.
6. Name: name it whatever you'd like that's specific to this project. cosc3380, for example.
7. Host: 192.168.10.10
8. Database: cosc3380
9. User: homestead
10. Password: secret
11. URL: leave alone
12. Driver: download if it's asking you to near the bottom
13. Click Test Connection.
14. Click Apply then Ok.

You should now be able to go to any SQL file within PHPStorm and press CTRL+Enter. You'll be prompted to select which statement you want to run.