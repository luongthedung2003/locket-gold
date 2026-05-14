import asyncio
import sys
import os

# Fix encoding for Windows console
if sys.platform == "win32":
    import io
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

# Get absolute path to bot directory
current_dir = os.path.dirname(os.path.abspath(__file__))
bot_dir = os.path.abspath(os.path.join(current_dir, "..", "Locket-Gold-BOT-main2"))

# CHANGE WORKING DIRECTORY to bot folder
os.chdir(bot_dir)
sys.path.append(".")

try:
    from app.web import start_web_server
except ImportError as e:
    # Try adding parent too
    sys.path.append(bot_dir)
    from app.web import start_web_server

async def main():
    # Start the engine on port 8080
    await start_web_server(port=8888)
    # Keep running
    while True:
        await asyncio.sleep(3600)

if __name__ == "__main__":
    try:
        asyncio.run(main())
    except KeyboardInterrupt:
        pass
