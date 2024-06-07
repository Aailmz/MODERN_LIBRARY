import 'package:flutter/material.dart';

class SalomonBottomBar extends StatelessWidget {
  const SalomonBottomBar({
    Key? key,
    required this.items,
    required this.currentIndex,
    required this.onTap,
    this.backgroundColor,
  }) : super(key: key);

  final List<SalomonBottomBarItem> items;
  final int currentIndex;
  final Function(int) onTap;
  final Color? backgroundColor;

  @override
  Widget build(BuildContext context) {
    final theme = Theme.of(context);

    return Container(
      color: backgroundColor,
      child: SafeArea(
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: items.map((item) {
            final index = items.indexOf(item);
            return GestureDetector(
              onTap: () => onTap(index),
              child: Container(
                padding: EdgeInsets.all(8),
                color: currentIndex == index ? theme.primaryColor : null,
                child: Row(
                  children: [
                    IconTheme(
                      data: IconThemeData(
                        color: currentIndex == index
                            ? Colors.white
                            : theme.iconTheme.color,
                      ),
                      child: currentIndex == index
                          ? item.activeIcon ?? item.icon
                          : item.icon,
                    ),
                    SizedBox(width: 8),
                    DefaultTextStyle(
                      style: TextStyle(
                        color: currentIndex == index ? Colors.white : null,
                        fontWeight: FontWeight.bold,
                      ),
                      child: item.title,
                    ),
                  ],
                ),
              ),
            );
          }).toList(),
        ),
      ),
    );
  }
}

class SalomonBottomBarItem {
  final Widget icon;
  final Widget title;
  final Widget? activeIcon;

  SalomonBottomBarItem({
    required this.icon,
    required this.title,
    this.activeIcon,
  });
}
