Vagrant.configure(2) do |config|
    provisioner = Vagrant::Util::Platform.windows? ? :guest_ansible : :ansible
    config.vm.define "herstelkamer", primary: true do |config|
        config.vm.box = "f500/debian-stretch64"
        config.vm.network :private_network, ip: "192.168.20.100"

        config.vm.synced_folder ".", "/vagrant"

        config.ssh.insert_key = false
        config.ssh.forward_agent = true

        config.vm.provider :virtualbox do |vb|
            vb.name = "herstelkamer"
            vb.customize ["modifyvm", :id, "--cpus", "1"]
            vb.customize ["modifyvm", :id, "--memory", "2048"]
            vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
        end

        config.vm.provision :ansible do |ansible|
            ansible.inventory_path     = "ansible/hosts"
            ansible.playbook           = "ansible/provision/provision.yml"
            ansible.limit              = "vagrant"
            ansible.host_key_checking  = "False"
        end
    end
end
