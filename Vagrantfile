# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure('2') do |config|
  # Box
  config.vm.define :vanilla_box do
    config.vm.box = 'ubuntu/bionic64'
    config.vm.box_check_update = false
    config.vm.hostname = 'vanilla-box'
  end
  # Memory
  config.vm.provider 'virtualbox' do |v|
    v.memory = 4096
    v.cpus = 4
  end
  # Network
  config.vm.network 'private_network', ip: '192.168.99.10'
  # Provision
  config.vm.provision 'ansible_local' do |ansible|
    ansible.verbose = false
    ansible.install = true
    ansible.become = true
    ansible.playbook = 'playbook.yml'
    ansible.provisioning_path = '/vagrant/ansible'
    ansible.extra_vars = { ansible_python_interpreter: '/usr/bin/python3' }
  end
end
