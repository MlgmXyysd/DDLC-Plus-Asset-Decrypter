# DDLC Plus Asset Decrypter
![Version: 1.1](https://img.shields.io/badge/Version-1.1-brightgreen?style=for-the-badge)

Doki Doki Literature Club Plus Asset Decrypter

Used to decrypt encrypted Streaming Asset Bundle files (*.cy) in DDLC-Plus.

## How to use
1. Download and install PHP for your system from the [official website](https://www.php.net/downloads).
2. Open the terminal and use PHP interpreter to execute the [script](ddlcpcydec.php) with the usage.
3. Wait for the script to run.
4. Use [Perfare/AssetStudio](https://github.com/Perfare/AssetStudio/) or other tools to unpack the decrypted asset file.

## Changelog
- v1.1:
    - Split file into 10M cache to speed up the decryption process
- v1.0:
    - First ver

## TO-DOs
- v1.3:
    - Use multiple threads to speed up the decryption process (Requires pthread extension)
- v1.2:
    - Iterate through paths to decrypt all files

## Workaround
The game has been cleared and I want to get its wallpaper and new music.

When I got the file, I found that its header is the same, but in an unknown format. By consulting the C# code, the game calls the regular AssetBundles load method. Nothing related to decryption was found in the C# code. I started to disassemble the native PE program and also found no code for decryption.

So I seemed to be stuck in a conundrum. I started to guess the encryption method, and the common ones are AES and XOR. But I didn't find any AES decryption method needed, so I ruled it out. Then I turned to XOR, starting by first guessing the key in a loop from 0 to 100.

Fortunately, the UnityFS file header and the Unity3D engine version were successfully decrypted when the XOR key was 40. By comparing it with StreamingAssets from other Unity3D powered games, I was convinced that this was the normally file.

Unpacked it using AssetStudio, everything worked fine and I got the wallpaper and music I wanted.

There is a saying in Chinese called "暴力出奇迹". Great discoveries require bold guesses, and often they work. :)

## Why do I use PHP
Simply, I hate Python syntax.

As an interpretive language, PHP has a friendly syntax similar to that of other languages and is easy to use.

In addition, ~~PHP is the best language in the world and does not accept any refutation~~. LMAO

## License
The project is open source under [Apache License v2.0](LICENSE). All rights reserved for script author [MlgmXyysd](https://github.com/MlgmXyysd/).
