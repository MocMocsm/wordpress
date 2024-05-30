#!/bin/bash

command="$1"
log_json="$2"
command_identifier="$3"

ensure_log_initialized() {
  # Extract the directory path from $log_json
    local log_dir=$(dirname "$log_json")

    # Ensure that the directory exists
    mkdir -p "$log_dir"

  # Ensure that the log file exists and is not empty
  if [ ! -s "$log_json" ]; then
    echo "[]" > "$log_json"
  fi
}

log_command_execution() {
  local command="$1"

  # Capture the start time
  local startTime=$(date --iso-8601=seconds)

  # Temporary files for unformatted stdout and stderr
  local stdoutTmp=$(mktemp)
  local stderrTmp=$(mktemp)

  # Temporary files for formatted (JSON) stdout and stderr
  local stdoutJsonTmp=$(mktemp)
  local stderrJsonTmp=$(mktemp)

  # Capture the start time
  local startTime=$(date --iso-8601=seconds)

  # Execute the command and capture the exit code, stdout, and stderr
  eval "$command" >"$stdoutTmp" 2>"$stderrTmp"
  local exitCode=$?

    cat "$stdoutTmp"
    cat "$stderrTmp" >&2

  # Format the unformatted stdout and stderr into JSON
  jq -Rsa 'split("\n")[:-1]' "$stdoutTmp" > "$stdoutJsonTmp"
  jq -Rsa 'split("\n")[:-1]' "$stderrTmp" > "$stderrJsonTmp"

  # Append the command execution details to the log JSON
  jq --arg startTime "$startTime" \
  --arg command "$command" \
  --arg exitCode "$exitCode" \
  --arg command_identifier "$command_identifier" \
  --slurpfile stdout "$stdoutJsonTmp" \
  --slurpfile stderr "$stderrJsonTmp" \
  '. += [{
    commandIdentifier: $command_identifier,
    startTime: $startTime,
    command: $command,
    exitCode: ($exitCode | tonumber),
    stdout: $stdout[0],
    stderr: $stderr[0]
  }]' "$log_json" > temp.json && mv temp.json "$log_json"

  # Cleanup temporary files
  rm "$stdoutTmp" "$stderrTmp"

  # Return the exit code of the executed command
  return $exitCode
}

ensure_log_initialized

log_command_execution "$command"