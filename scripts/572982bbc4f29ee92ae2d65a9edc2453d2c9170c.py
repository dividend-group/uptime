# a script to ping servers

import platform
import subprocess
import json

args = input()
servers = json.loads(args)

def ping(servers):
    ping_responses = {}
    for server in servers:
        cmd_param = "-n" if platform.system().lower() == 'windows' else "-c"
        cmd = f"ping {cmd_param} 1 {server}"
        ping_result = subprocess.run(cmd, capture_output=True)
        ping_responses[server] = ping_result.returncode == 0

    return json.dumps(ping_responses)
    
print(ping(servers))